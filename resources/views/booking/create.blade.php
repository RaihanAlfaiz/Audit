@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="event_id">Event</label>
                                    <select name="event_id" id="event_id" class="form-control" onchange="updateRemainingPayment()">
                                        @foreach($events as $event)
                                        <option value="{{ $event->id }}" data-remaining-payment="{{ $event->remaining_payment }}" {{ $event->id == $eventId ? 'selected' : '' }}>
                                            {{ $event->tenant_name }} - {{ $event->package->Name }}
                                        </option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="remaining_payment" class="form-label">Remaining Payment</label>
                                    <input type="text" name="remaining_payment" id="remaining_payment" class="form-control" readonly disabled value="{{ old('remaining_payment') }}">
                                </div>

                                <div class="mb-3">
                                    <label for="total_payment" class="form-label">Total Payment</label>
                                    <input type="text" name="total_payment" class="form-control readonly-input" id="total_payment" readonly placeholder="Total payment" value="{{ old('total_payment') }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="receipt_full" class="form-label">Receipt Full</label>
                                    <img class="img-preview img-fluid mb-3 col-sm-5" id="receipt_full_preview" src="{{ old('receipt_full_preview') }}">
                                    <input class="form-control @error('receipt_full') is-invalid @enderror" type="file" id="receipt_full" name="receipt_full" onchange="previewImage(event)">
                                    @error('receipt_full')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="ktp" class="form-label">KTP</label>
                                    <img class="img-preview img-fluid mb-3 col-sm-5" id="ktp_preview" src="{{ old('ktp_preview') }}">
                                    <input class="form-control @error('ktp') is-invalid @enderror" type="file" id="ktp" name="ktp" onchange="previewImage(event)">
                                    @error('ktp')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Do you want to add additional tools?</label>
                            <div>
                                <input type="radio" id="add_tools_yes" name="add_tools" value="yes" {{ old('add_tools') == 'yes' ? 'checked' : '' }} onchange="toggleAdditionForm()"> Yes
                                <input type="radio" id="add_tools_no" name="add_tools" value="no" {{ old('add_tools') == 'no' ? 'checked' : '' }} onchange="toggleAdditionForm()"> No
                            </div>
                        </div>

                        <div id="additionalForm" style="display: {{ old('add_tools') == 'yes' ? 'block' : 'none' }};">
                            <div class="card-body mt-3">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Addition</div>
                                    <div class="panel-body">
                                        <div id="addition_fields">
                                            @if(old('service_id'))
                                                @foreach(old('service_id') as $key => $serviceId)
                                                    <div class="row mb-3">
                                                        <div class="col-sm-3">
                                                            <select class="selectpicker w-100" data-style="btn-default" data-live-search="true" name="service_id[]" onchange="updateServiceDetails(this)">
                                                                <option value="">Select Service</option>
                                                                @foreach($services as $service)
                                                                    <option value="{{ $service->id }}" data-price="{{ $service->price }}" {{ $serviceId == $service->id ? 'selected' : '' }}>
                                                                        {{ $service->item }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" name="price[]" placeholder="Service Price" value="{{ old('price.'.$key) }}" readonly>
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" name="quantity[]" placeholder="Quantity" value="{{ old('quantity.'.$key) }}" oninput="updateTotalPrice(this)">
                                                        </div>
                                                        <div class="col-sm-2">
                                                            <input type="text" class="form-control" name="price_per_unit[]" placeholder="Total Price" value="{{ old('price_per_unit.'.$key) }}" readonly>
                                                        </div>
                                                        <div class="col-sm-3 d-flex align-items-center">
                                                            <button class="btn btn-danger" type="button" onclick="remove_addition_fields(this);">Remove</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="row mb-3">
                                                    <div class="col-sm-3">
                                                        <select class="selectpicker w-100" data-style="btn-default" data-live-search="true" name="service_id[]" onchange="updateServiceDetails(this)">
                                                            <option value="">Select Service</option>
                                                            @foreach($services as $service)
                                                                <option value="{{ $service->id }}" data-price="{{ $service->price }}">
                                                                    {{ $service->item }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="price[]" placeholder="Service Price" readonly>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="quantity[]" placeholder="Quantity" oninput="updateTotalPrice(this)">
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <input type="text" class="form-control" name="price_per_unit[]" placeholder="Total Price" readonly>
                                                    </div>
                                                    <div class="col-sm-3 d-flex align-items-center">
                                                        <button class="btn btn-primary" type="button" onclick="add_addition_fields();">Add More</button>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}">
</script> 
<script>
    document.addEventListener("DOMContentLoaded", function() {
        updateRemainingPayment();
    });

    function updateServiceDetails(element) {
        var row = element.closest('.row');
        var price = element.options[element.selectedIndex].getAttribute('data-price');
        row.querySelector('input[name="price[]"]').value = price;
        updateTotalPrice(row.querySelector('input[name="quantity[]"]'));
    }

    function updateTotalPrice(element) {
        var row = element.closest('.row');
        var price = parseFloat(row.querySelector('input[name="price[]"]').value) || 0;
        var quantity = parseFloat(element.value) || 0;
        var totalPrice = price * quantity;
        row.querySelector('input[name="price_per_unit[]"]').value = totalPrice;
        updateTotalPayment();
    }

    function updateTotalPayment() {
        var remainingPayment = parseFloat(document.getElementById('remaining_payment').value.replace('Rp ', '').replace(/\./g, '').replace(',', '.')) || 0;
        var additionPrices = document.querySelectorAll('input[name="price_per_unit[]"]');
        var additionalTotal = Array.from(additionPrices).reduce((acc, input) => acc + (parseFloat(input.value) || 0), 0);
        var totalPayment = remainingPayment + additionalTotal;
        document.getElementById('total_payment').value = 'Rp ' + totalPayment.toLocaleString('id-ID');
    }

    function toggleAdditionForm() {
        var addToolsYes = document.getElementById('add_tools_yes').checked;
        var additionalForm = document.getElementById('additionalForm');
        if (addToolsYes) {
            additionalForm.style.display = 'block';
        } else {
            additionalForm.style.display = 'none';
            resetAdditionalForm();
        }
        updateTotalPayment();
    }

    function resetAdditionalForm() {
        var additionFields = document.getElementById('addition_fields');
        while (additionFields.firstChild) {
            additionFields.removeChild(additionFields.firstChild);
        }
    }

    var room = 1;

    function add_addition_fields() {
        room++;
        var objTo = document.getElementById('addition_fields');
        var divtest = document.createElement("div");
        divtest.setAttribute("class", "row mb-3 removeclass" + room);
        var rdiv = 'removeclass' + room;
        divtest.innerHTML = `
            <div class="col-sm-3">
                <select class="selectpicker w-100"  data-style="btn-default" data-live-search="true" name="service_id[]" onchange="updateServiceDetails(this)">
                    <option value="">Select Service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->item }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="price[]" placeholder="Service Price" readonly>
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="quantity[]" placeholder="Quantity" oninput="updateTotalPrice(this)">
            </div>
            <div class="col-sm-2">
                <input type="text" class="form-control" name="price_per_unit[]" placeholder="Total Price" readonly>
            </div>
            <div class="col-sm-3 d-flex align-items-center">
                <button class="btn btn-danger" type="button" onclick="remove_addition_fields(${room});">Remove</button>
            </div>
        `;
        objTo.appendChild(divtest);
    $(".selectpicker").selectpicker();

    }

    function remove_addition_fields(rid) {
        document.querySelector('.removeclass' + rid).remove();
        updateTotalPayment();
    }

    function updateRemainingPayment() {
        var eventSelect = document.getElementById('event_id');
        var remainingPayment = eventSelect.options[eventSelect.selectedIndex].getAttribute('data-remaining-payment');
        document.getElementById('remaining_payment').value = 'Rp ' + parseFloat(remainingPayment).toLocaleString('id-ID');
        updateTotalPayment();
    }

    function previewImage(event){
        const input = event.target;
        const imgPreview = document.querySelector(`#${input.id}_preview`);

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(input.files[0]);

        oFReader.onload = function(oFREvent){
            imgPreview.src = oFREvent.target.result;
        }
    }
    $(".selectpicker").selectpicker();
</script>
@endsection
