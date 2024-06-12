@extends('layouts.master')
@section('css') 
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<style>
    /* CSS untuk membuat input field mirip dengan input field yang dinonaktifkan */
    .readonly-input {
        background-color: #f0f0f0; /* Warna latar belakang yang mirip dengan input field yang dinonaktifkan */
        border: 1px solid #ddd; /* Garis tepi yang mirip dengan input field yang dinonaktifkan */
        cursor: not-allowed; /* Mengubah kursor saat mengarahkan ke input field */
    }
</style>
@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('event.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tenant_name" class="form-label">Tenant Name</label>
                                    <input type="text" name="tenant_name" class="form-control @error('tenant_name') is-invalid @enderror" id="tenant_name" placeholder="Enter the tenant's name" value="{{ old('tenant_name') }}">
                                    @error('tenant_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="event_name" class="form-label">Event Name</label>
                                    <input type="text" name="event_name" class="form-control @error('event_name') is-invalid @enderror" id="event_name" placeholder="Enter the tenant's name" value="{{ old('event_name') }}">
                                    @error('event_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Enter the tenant's name" value="{{ old('email') }}">
                                    
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <small class="form-text text-primary">* Email is optional.</small>
                                </div>

                                <div class="mb-3">
                                    <label for="institution_origin" class="form-label">Institution Origin</label>
                                    <input type="text" name="institution_origin" class="form-control @error('institution_origin') is-invalid @enderror" id="institution_origin" placeholder="Enter the Institution origin" value="{{ old('institution_origin') }}">
                                    @error('institution_origin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="phone" class="form-label">Number Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter the Number Phone Ex:08XXXXXXXX" value="{{ old('phone') }}">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="Number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" id="capacity" placeholder="Enter the capacity" value="{{ old('capacity') }}">
                                    @error('capacity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="rehearsal_date" class="form-label">Rehearsal Date</label>
                                    <input type="date" name="rehearsal_date" class="form-control @error('rehearsal_date') is-invalid @enderror" id="rehearsal_date" placeholder="Enter the rehearsal date" value="{{ old('rehearsal_date') }}">
                                    @error('rehearsal_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <small class="form-text text-primary">* Rehearsal date is optional.</small>
                                </div>
                              
                               

                                

                              
                                
                            </div>

                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="event_date" class="form-label">Event date</label>
                                    <input type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" placeholder="Enter the event_date" value="{{ old('event_date') }}">
                                    @error('event_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Start Time Event</label>
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" placeholder="Enter the start time event" value="{{ old('start_time') }}">
                                    @error('start_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="end_time" class="form-label">End Time Event</label>
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" placeholder="Enter the end time event" value="{{ old('end_time') }}">
                                    @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="package_id" class="form-label">Choose Package</label>
                                    <select id="package_id" name="package_id" class="selectpicker w-100" data-style="btn-default" data-live-search="true">
                                        <option value="">Pilih package</option>
                                        @foreach($packages as $package)
                                        <option value="{{ $package->id }}" data-price="{{ $package->price }}">{{ $package->Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('package_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="package_price" class="form-label">Price Package</label>
                                    <input type="text" id="package_price" class="form-control readonly-input" readonly placeholder="Price Package">
                                </div>

                                <div class="mb-3">
                                    <label for="payment_amount" class="form-label">The price want to pay</label>
                                    <input type="text" name="payment_amount" class="form-control" id="payment_amount" placeholder="Enter the payment amount">
                                </div>

                                <div class="mb-3">
                                    <label for="remaining_payment" class="form-label">Remaining payment</label>
                                    <input type="text" name="remaining_payment" class="form-control readonly-input" id="remaining_payment" readonly placeholder="Remaining payment">
                                </div>
                                
                               

                                <div class="mb-3">
                                    <label for="receipt_dp" class="form-label">Receipt DP</label>
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                    <input class="form-control @error('receipt_dp') is-invalid @enderror" type="file" id="receipt_dp" name="receipt_dp" onchange="previewImage()">
                                    @error('receipt_dp')
                                    <div class="invalid-feedback">
                                      {{ $message }}
                                    </div>
                                    @enderror
                                </div>



                                
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script> 

<script>
     function previewImage(){
      const image = document.querySelector('#receipt_dp');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
      }
    }

const myDropzone = new Dropzone('#dropzone-basic', {
  previewTemplate: previewTemplate,
  parallelUploads: 1,
  maxFilesize: 5,
  addRemoveLinks: true,
  maxFiles: 1
});

$(".selectpicker").selectpicker();
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#package_id').change(function() {
            var packageId = $(this).val();

            // Kirim AJAX request untuk mendapatkan harga paket
            $.ajax({
                url: '/get-package-price/' + packageId, // Ganti URL dengan endpoint yang sesuai
                type: 'GET',
                success: function(response) {
                    $('#package_price').val(response.price);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendengarkan perubahan pada input jumlah pembayaran
        document.getElementById('payment_amount').addEventListener('input', function() {
            // Mendapatkan harga paket berdasarkan package_id yang dipilih
            var packageId = document.getElementById('package_id').value;
            var packagePrice = parseFloat(document.querySelector('option[value="' + packageId + '"]').getAttribute('data-price'));
            
            // Mendapatkan jumlah pembayaran yang dimasukkan pengguna
            var paymentAmount = parseFloat(this.value);
            
            // Menghitung sisa pembayaran
            var remainingPayment = packagePrice - paymentAmount;
            
            // Menghindari nilai negatif
            var absoluteRemainingPayment = Math.max(0, remainingPayment);

            // Menampilkan sisa pembayaran di dalam input "remaining_payment"
            document.getElementById('remaining_payment').value = absoluteRemainingPayment.toFixed(2); // Menampilkan 2 digit desimal
        });
    });
</script>



@endsection
