@extends('layouts.master')
@section('css')
<style>
    .img-fluid{
        width: 100px;
        height: 100px;
    }
    .gallery .gallery-item {
  overflow: hidden;
  border-right: 3px solid #fff;
  border-bottom: 20px solid #fff;
}

.gallery .gallery-item img {
  transition: all ease-in-out 0.4s;
}

.gallery .gallery-item:hover img {
  transform: scale(1.1);
}
</style>
@endsection
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
                            @if ($booking && $booking->receipt_full)
                            <div class="mb-3">
                                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                                    <strong>Receipt Ful:</strong><br>
                                    <a href="{{ asset('storage/' . $booking->receipt_full) }}" class="gallery-lightbox">
                                        <img src="{{ asset('storage/' . $booking->receipt_full) }}" class="img-fluid" alt="Receipt DP">
                                    </a>
                                </div>
                            </div>
                        @endif
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
                                @if ($booking && $booking->receipt_full)
                                    <p>Lunas</p>
                                @else
                                <p>{{ 'Rp ' . number_format($event->remaining_payment, 0, ',', '.') }}</p>
                                @endif
                            </div>
                            @if ($event->receipt_dp)
                            <div class="mb-3">
                                <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
                                    <strong>Receipt DP:</strong><br>
                                    <a href="{{ asset('storage/' . $event->receipt_dp) }}" class="gallery-lightbox">
                                    <img src="{{ asset('storage/' . $event->receipt_dp) }}" class="img-fluid" alt="Receipt DP">
                                </a>
                                </div>
                            </div>
                        @endif

                      
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
<script>
    const galleryLightbox = GLightbox({
    selector: '.gallery-lightbox'
  });
</script>
@endsection