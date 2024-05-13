@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css ')}}" />

@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('booking.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="event_id">Event</label>
                                <select name="event_id" id="event_id" class="form-control">
                                        @foreach($events as $event)
                                            <option value="{{ $event->id }}">{{ $event->tenant_name }} - {{ $event->package->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="booking_date" class="form-label">Remaining Paymet</label>
                                    <input type="text" name="booking_date" class="form-control" value="{{ 'Rp ' . number_format($event->remaining_payment, 0, ',', '.') }}" readonly >
                                
                                </div>

                                <div class="mb-3">
                                    <label for="payment" class="form-label">Payment</label>
                                    <input type="text" name="payment" class="form-control @error('payment') is-invalid @enderror" id="payment" placeholder="Enter the Total Payment" value="{{ old('payment') }}">
                                    @error('payment')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="text" name="discount" class="form-control @error('discount') is-invalid @enderror" id="discount" placeholder="Enter the Discount" value="{{ old('discount') }}">
                                    @error('discount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="total_payment" class="form-label">Total Payment</label>
                                    <input type="text" name="total_payment" class="form-control" id="total_payment" placeholder="Total Payment" value="{{ old('total_payment') }}" readonly>
                                    <!-- Readonly attribute prevents users from changing the value -->
                                    @error('total_payment')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                             
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="TagifyBasic" class="form-label">Include Tools</label>
                                    <input id="TagifyBasic" class="form-control @error('include_tools') is-invalid @enderror" name="include_tools" placeholder="Enter the include tools"  value="{{ old('include_tools') }}"/>
                                    @error('include_tools')
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
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>

<script>
    $(".selectpicker").selectpicker();
    const tagifyBasicEl = document.querySelector("#TagifyBasic");
    const TagifyBasic = new Tagify(tagifyBasicEl);
    // Ambil elemen input
    var inputPayment = document.getElementById('payment');
    var inputDiscount = document.getElementById('discount');
    var inputTotalPayment = document.getElementById('total_payment');

    // Tambahkan event listener untuk mengubah format saat nilai diubah
    inputPayment.addEventListener('input', function() {
        // Hapus semua karakter non-digit dari nilai input
        var rawPaymentValue = this.value.replace(/\D/g, '');
        // Format nilai menjadi rupiah
        var formattedPaymentValue = 'Rp ' + formatRupiah(rawPaymentValue);
        // Tampilkan nilai yang diformat pada input
        this.value = formattedPaymentValue;
        // Update total payment saat nilai pembayaran diubah
        updateTotalPayment();
    });

    inputDiscount.addEventListener('input', function() {
        // Hapus semua karakter non-digit dari nilai input
        var rawDiscountValue = this.value.replace(/\D/g, '');
        // Tampilkan nilai diskon yang diformat pada input
        this.value = 'Rp ' + formatRupiah(rawDiscountValue);
        // Update total payment saat nilai diskon diubah
        updateTotalPayment();
    });

    // Fungsi untuk menghitung dan menampilkan total payment
    function updateTotalPayment() {
        var rawPaymentValue = parseInt(inputPayment.value.replace(/\D/g, ''));
        var rawDiscountValue = parseInt(inputDiscount.value.replace(/\D/g, '')) || 0; // Set default value untuk diskon
        var totalPaymentValue = rawPaymentValue - rawDiscountValue;
        // Format nilai total payment menjadi rupiah
        var formattedTotalPayment = 'Rp ' + formatRupiah(totalPaymentValue);
        // Tampilkan nilai total payment yang diformat pada input
        inputTotalPayment.value = formattedTotalPayment;
    }

    // Fungsi untuk mengubah angka menjadi format rupiah
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var formatted = ribuan.join('.').split('').reverse().join('');
        return formatted;
    }
</script>
@endsection