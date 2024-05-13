@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('event.update', ['id' => $event->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="tenant_name" class="form-label">Tenant Name</label>
                                    <input type="text" name="tenant_name" class="form-control @error('tenant_name') is-invalid @enderror" id="tenant_name" placeholder="Enter the tenant's name" value="{{ $event->tenant_name}}">
                                    @error('tenant_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="institution_origin" class="form-label">Institution Origin</label>
                                    <input type="text" name="institution_origin" class="form-control @error('institution_origin') is-invalid @enderror" id="institution_origin" placeholder="Enter the Institution origin" value="{{ $event->Institution_origin}}">
                                    @error('institution_origin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="phone" class="form-label">Number Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter the Number Phone Ex:08XXXXXXXX" value="{{ $event->phone}}">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="Number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" id="capacity" placeholder="Enter the capacity" value="{{ $event->capacity }}">
                                    @error('capacity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="package_id" class="form-label">Pilih package</label>
                                    <select id="package_id" name="package_id" class="form-select">
                                        <option value="">Pilih package</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}" {{ $event->package_id == $package->id ? 'selected' : '' }}>{{ $package->Name }}</option>
                                        @endforeach
                                    </select>
                                    @error('package_id')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>    
                                    @enderror
                                </div>
                                
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="rehearsal_date" class="form-label">Rehearsal Date</label>
                                    <input type="date" name="rehearsal_date" class="form-control @error('rehearsal_date') is-invalid @enderror" id="rehearsal_date" placeholder="Enter the rehearsal date" value="{{ $event->rehearsal_date }}">
                                    @error('rehearsal_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                              
                                <div class="mb-3">
                                    <label for="event_date" class="form-label">Event date</label>
                                    <input type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror" id="event_date" placeholder="Enter the event_date" value="{{ $event->event_date }}">
                                    @error('event_date')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="start_time" class="form-label">Start Time Event</label>
                                    <input type="time" name="start_time" class="form-control @error('start_time') is-invalid @enderror" id="start_time" placeholder="Enter the start time event" value="{{ $event->start_time }}">
                                    @error('start_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="end_time" class="form-label">End Time Event</label>
                                    <input type="time" name="end_time" class="form-control @error('end_time') is-invalid @enderror" id="end_time" placeholder="Enter the end time event" value="{{ $event->end_time }}">
                                    @error('end_time')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="receipt_dp" class="form-label">Receipt DP</label>
                                    <input type="hidden" name="oldImage" id="" value="{{ $event->receipt_dp }}">
                                    @if ($event->receipt_dp)
                                      <img src="{{ asset('storage/' . $event->receipt_dp) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                                        @else
                                        <img class="img-preview img-fluid mb-3 col-sm-5">
                                    @endif
                                    
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
</script>
@endsection
