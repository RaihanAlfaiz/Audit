@extends('layouts.master')
@section('breadcrumb-items')
<span class="text-muted fw-light">Package / Edit</span>
@endsection
@section('css') 
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

@endsection
@section('content')

<div class="card app-calendar-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                    <form action="{{ route('package.update', ['id' => $package->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name Package</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter the Package's name" value="{{ $package->Name }}">
                                @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror

                                
                            </div>

                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                @error('item')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="item" type="hidden" name="item" value="{{ $package->item }}">
                                <trix-editor input="item"></trix-editor>
                              </div>

                              

                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the Price" value="{{ $package->price}}">
                                </div>
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="body" class="form-label">Service</label>
                                @error('service')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input id="service" type="hidden" name="service" value="{{ $package->service }}">
                                <trix-editor input="service"></trix-editor>
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
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<!-- Jika diperlukan script tambahan -->
{{-- <script>
        function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        ribuan = ribuan.join('.').split('').reverse().join('');
        return ribuan;
    }

    // Fungsi untuk memformat input secara otomatis saat diketik
    document.getElementById('price').addEventListener('keyup', function(e) {
        // Menghapus karakter selain angka dari input
        var value = this.value.replace(/\D/g, '');
        // Memformat angka ke format mata uang Rupiah
        this.value = formatRupiah(value);
    });
</script> --}}
@endsection