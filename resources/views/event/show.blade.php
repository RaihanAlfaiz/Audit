@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white mb-3">Event Detail</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>Tenant Name:</strong>
                                <p>{{ $event->tenant_name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Institution Origin:</strong>
                                <p>{{ $event->institution_origin }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Number Phone:</strong>
                                <p>{{ $event->phone }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Capacity:</strong>
                                <p>{{ $event->capacity }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Event Date:</strong>
                                <p>{{ date('d/m/Y', strtotime($event->event_date)) }}</p>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <strong>About:</strong>
                                <p>{{ $event->about }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Rehearsal Date:</strong>
                                <p>{{ date('d/m/Y', strtotime($event->rehearsal_date)) }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Venue:</strong>
                                <p>{{ $event->venue }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Description:</strong>
                                <p>{{ $event->description }}</p>
                            </div>
                            <div class="mb-3">
                               <a href="{{ route('event') }}" class="btn btn-primary">Kembali</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<!-- Jika diperlukan script tambahan -->
@endsection