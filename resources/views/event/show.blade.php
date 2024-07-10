@extends('layouts.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row invoice-preview">
    <!-- Invoice -->
    <div id="printableArea" class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
      <div class="card invoice-preview-card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column p-sm-3 p-0">
            <div class="mb-xl-0 mb-4">
              <div class="d-flex svg-illustration mb-3 gap-2">
                <span class="app-brand-logo demo">
                  <img src="{{ asset('assets/img/logo-jgu.png') }}" alt="" width="100">
                </span>
              </div>
              <p class="mb-1">Jl. Boulevard Grand Depok City, Tirtajaya,</p>
              <p class="mb-1">Kec. Sukmajaya, Kota Depok, Jawa Barat 16412</p>
              <p class="mb-0">Telp : 021 - ******</p>
            </div>
            <div>
              <div class="mb-2">
                <span class="me-1">Date Issued:</span>
                <span class="fw-medium">{{ date('d/m/Y', strtotime($event->created_at)) }}</span>
              </div>
            </div>
          </div>
        </div>
        <hr class="my-0" />
        <div class="card-body">
          <div class="row p-sm-3 p-0">
            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
              <h6 class="pb-2">Ordered By:</h6>
              <p class="mb-1">{{ $event->tenant_name }}</p>
              <p class="mb-1">{{ $event->event_name }}</p>
              <p class="mb-1">{{ $event->Institution_origin }}</p>
              <p class="mb-1">{{ $event->phone }}</p>
              <p class="mb-0">{{ $event->email }}</p>
            </div>
            <div class="col-xl-6 col-md-12 col-sm-7 col-12">
              <h6 class="pb-2">Bill To:</h6>
              <table>
                <tbody>
                  <tr>
                    <td class="pe-3">Package:</td>
                    <td>{{ $event->package->Name }}</td>
                  </tr>
                  <tr>
                    <td class="pe-3">Event Date:</td>
                    <td>{{ date('d/m/Y', strtotime($event->event_date)) }}</td>
                  </tr>
                  @if ($event->rehearsal_date)
                  <tr>
                    <td class="pe-3">Rehearsal Date:</td>
                    <td>{{ date('d/m/Y', strtotime($event->rehearsal_date)) }}</td>
                  </tr>
                  @endif
                  <tr>
                    <td class="pe-3">Start - end:</td>
                    <td>{{ $event->start_time }} - {{ $event->end_time }}</td>
                  </tr>
                  <tr>
                    <td class="pe-3">Status:</td>
                    <td><i class="badge rounded-pill bg-{{ $event->color }}" style="font-size:10pt;">{{ $event->status }}</i></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table border-top m-0">
            <thead>
              <tr>
                <th>Remaining Payment</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="text-nowrap">{{ $event->package->Name }}</td>
                @if ($booking && $booking->receipt_full)
                <td>Lunas</td>
                @else
                <td>{{ 'Rp ' . number_format($event->remaining_payment, 0, ',', '.') }}</td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>
        
        <div class="card-body d-flex flex-column justify-content-end" style="height: 400px;">
          <div class="row mt-auto">
            <div class="col-12">
              <span class="fw-medium">Note:</span>
              <span>Ini adalah bukti transfer yang harus dipegang oleh pihak management agar tidak terjadi pemalsuan</span>
            </div>
          </div>
          <div class="text-center">
            @if ($booking && $booking->receipt_full)
            <img src="{{ asset('storage/' . $booking->ktp) }}" alt="Receipt DP" width="400" height="200" style="margin-left: 10px; margin-bottom: 10px; margin-top: 20px;">">
            @endif
          </div>
        </div>
     
        {{-- <div class="page-break"></div> --}}
        <div class="text-center">
          @if ($event->receipt_dp)
          <img src="{{ asset('storage/' . $event->receipt_dp) }}" alt="Receipt DP" width="300" height="600" style="margin-right: 10px; margin-bottom: 10px;">
          @endif
          @if ($booking && $booking->receipt_full)
          <img src="{{ asset('storage/' . $booking->receipt_full) }}" alt="Receipt DP" width="300" height="600" style="margin-left: 10px; margin-bottom: 10px;">
          @endif
        </div>
      </div>
    </div>
    <!-- /Invoice -->
    <!-- Invoice Actions -->
    <div class="col-xl-3 col-md-4 col-12 invoice-actions">
      <div class="card">
        <div class="card-body">
          <a href="javascript:void(0)" class="btn btn-label-secondary d-grid w-100 mb-3" onclick="printDiv('printableArea')" target="_blank">Print</a>
          <a href="{{ route('event') }}" class="btn btn-primary d-grid w-100 mb-3">Kembali</a>
        </div>
      </div>
    </div>
    <!-- /Invoice Actions -->
  </div>
</div>

@endsection

@section('script')
<script>
  function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
  }
</script>
<style>
  .page-break {
    page-break-before: always;
  }
</style>
@endsection
