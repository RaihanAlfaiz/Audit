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
                                <p>{{ $event->Institution_origin }}</p>
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
                                <strong>Package:</strong>
                                <p>{{ $event->package->Name }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Rehearsal Date:</strong>
                                <p>{{ date('d/m/Y', strtotime($event->rehearsal_date)) }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Start - end:</strong>
                                <p>{{ $event->start_time }} - {{ $event->end_time }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Status:</strong>
                                <p><i class="badge rounded-pill bg-{{ $event->color }}" style="font-size:10pt;">{{ $event->status }}</i></p>
                            </div>
                            <div class="mb-3">
                                <strong>Remaining Payment:</strong>
                                <p>{{ 'Rp ' . number_format($event->remaining_payment, 0, ',', '.') }}</p>
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