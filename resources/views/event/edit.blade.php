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
                                    <input type="text" name="institution_origin" class="form-control @error('institution_origin') is-invalid @enderror" id="institution_origin" placeholder="Enter the Institution origin" value="{{ $event->institution_origin}}">
                                    @error('institution_origin')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label for="phone" class="form-label">Number Phone</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" placeholder="Enter the Number Phone Ex:08XXXXXXXX" value="{{$event->phone }}">
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input type="Number" name="capacity" class="form-control @error('capacity') is-invalid @enderror" id="capacity" placeholder="Enter the capacity" value="{{$event->capacity }}">
                                    @error('capacity')
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
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="about" class="form-label">About</label>
                                    <input type="text" name="about" class="form-control @error('about') is-invalid @enderror" id="about" placeholder="Enter the about" value="{{ $event->about}}">
                                    @error('about')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

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
                                    <label for="venue" class="form-label">Venue</label>
                                    <input type="text" name="venue" class="form-control @error('venue') is-invalid @enderror" id="venue" placeholder="Enter the venue" value="{{ $event->venue}}">
                                    @error('venue')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" id="autosize-demo" rows="3" class="form-control @error('description') is-invalid @enderror" placeholder="Enter the description">{{$event->description}}</textarea>

                                    @error('description')
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

</script>
@endsection
