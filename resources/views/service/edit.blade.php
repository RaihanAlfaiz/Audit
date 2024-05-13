@extends('layouts.master')
@section('css') 
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">

<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />

@endsection
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
               
                <div class="card-body">
                    <form action="{{ route('service.update', ['id' => $service->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="item" class="form-label">Item</label>
                                <input type="text" name="item" class="form-control @error('item') is-invalid @enderror" id="item" placeholder="Enter the Name's item" value="{{ $service->item }}">
                                @error('item')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror                                
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" id="price" placeholder="Enter the Price" value="{{ $service->price}}">
                                </div>
                                @error('price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="unit" class="form-label">Unit</label>
                                <input type="number" name="unit" class="form-control @error('unit') is-invalid @enderror" id="unit" placeholder="Enter the Total unit" value="{{ $service->unit }}">
                                @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror                                
                            </div>

                            <div class="mb-3">
                                <label for="unit_name" class="form-label">Unit Name</label>
                                <input type="text" name="unit_name" class="form-control @error('unit_name') is-invalid @enderror" id="unit_name" placeholder="Example : Ruangan, Set Buah" value="{{ $service->unit_name }}">
                                @error('unit_name')
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
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script> 

<!-- Jika diperlukan script tambahan -->
<script>
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
</script>
@endsection