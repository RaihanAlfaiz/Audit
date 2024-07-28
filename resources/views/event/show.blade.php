<!DOCTYPE html>

<html lang="en" class="light-style   layout-menu-fixed     " dir="ltr" data-theme="theme-default" data-assets-path="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/" data-base-url="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo-1" data-framework="laravel" data-template="blank-menu-theme-default-light" data-style="light">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Print version - Invoice | {{ $event->tenant_name }}</title>
  <meta name="description" content="Most Powerful &amp; Comprehensive Bootstrap 5 HTML Admin Dashboard Template built for developers!" />
  <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
  <!-- laravel CRUD token -->
  <meta name="csrf-token" content="2Lhq0JjdFjM5DrVLYdPTsl1xO9nVM9wk2Wla45K2">
  <!-- Canonical SEO -->
  <link rel="canonical" href="https://themeselection.com/item/sneat-bootstrap-laravel-admin-template/">
  
  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
  <link rel="stylesheet" href="{{ asset('assets/vendor/css/datatables.bootstrap5.css') }}">

  <!-- Custom CSS for Page Breaks -->
  <style>
    .page-break {
      page-break-before: always;
    }
  </style>
</head>

<body>
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>

  <!-- Layout Content -->
  
  <!-- Content -->
  <div class="invoice-print p-12">
    <div class="d-flex justify-content-between flex-row">
      <div class="mb-6">
        <div class="d-flex svg-illustration mb-6 gap-2 align-items-center">
          <span class="app-brand-logo demo"> <img src="{{ asset('assets/img/4.png') }}" alt="" width="100">
          </span>
        </div>
        <p class="mb-1">Jl. Boulevard Grand Depok City, Tirtajaya,</p>
        <p class="mb-1">Kec. Sukmajaya, Kota Depok, Jawa Barat 16412</p>
        <p class="mb-0">Telp : 021 - ******</p>
      </div>
      <div>
        <div class="mb-1">
          <span class="me-1">Date Issued:</span>
          <span class="fw-medium">{{ date('d F Y', strtotime($event->created_at)) }}</span>
        </div>
      </div>
    </div>

    <hr class="mb-6" />

    <div class="row d-flex justify-content-between mb-6">
      <div class="col-sm-6 w-50">
        <h6>Invoice To:</h6>
        <p class="mb-1">Name   : {{ $event->tenant_name }}</p>
        <p class="mb-1">Origin : {{ $event->Institution_origin }}</p>
        <p class="mb-1">Event  : {{$event->event_name  }}</p>
        <p class="mb-1">Telp   : {{ $event->phone }}</p>
        <p class="mb-1">Email  : {{ $event->email }}</p>
      </div>
      <div class="col-sm-6 w-50">
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
              <td>{{ $event->status }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="table-responsive border border-bottom-0 rounded">
      <table class="table m-0">
        <thead>
          <tr>
            <th>No</th>
            <th>Description</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          @php
          $no = 1;
          $total_amount = 0;
          @endphp
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $package->Name }}</td>
            <td>1</td>
            <td>Rp&nbsp;{{ number_format($package->price, 2, ',', '.') }}</td>
            <td>Rp&nbsp;{{ number_format($package->price, 2, ',', '.') }}</td>
          </tr>
          @php
          $total_amount += $package->price;
          @endphp
          @foreach ($additions as $addition)
          @php
          $service = \App\Models\Service::find($addition->service_id);
          $amount = $addition->price_per_unit; // Menggunakan price_per_unit langsung sebagai amount
          @endphp
          <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $service->item }}</td>
            <td>{{ $addition->quantity }} ({{ $service->unit_name }})</td>
            <td>Rp&nbsp;{{ number_format($service->price, 2, ',', '.') }}</td>
            <td>Rp&nbsp;{{ number_format($amount, 2, ',', '.') }}</td>
          </tr>
          @php
          $total_amount += $amount;
          @endphp
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="table-responsive">
      <table class="table m-0 table-borderless">
        <tbody>
          <tr>
            <td class="align-top px-6 py-6">
              <p class="mb-1">
                <span class="me-2 fw-medium">Salesperson:</span>
                <span>Jakarta Global University</span>
              </p>
              <span>Thanks for your business</span>
            </td>
            <td class="px-0 py-12 w-px-100">
              <p class="mb-2">Subtotal:</p>
              <p class="mb-2 border-bottom pb-2">Payment:</p>
              <p class="mb-0 pt-2">Total:</p>
            </td>
            <td class="text-end px-0 py-6 w-px-100">
              <p class="fw-medium mb-2">Rp&nbsp;{{ number_format($total_amount, 2, ',', '.') }}</p>
              <p class="fw-medium mb-2 border-bottom pb-2">Rp&nbsp;{{ number_format($total_amount, 2, ',', '.') }}</p>
              <p class="fw-medium mb-0 pt-2">Rp&nbsp; 0 (LUNAS)</p>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <hr class="mt-0 mb-6">
    <div class="row">
      <div class="col-12">
        <span class="fw-medium">Note:</span>
        <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</span>
      </div>
    </div>

    <!-- Photos Section -->
    @if ($event->receipt_dp)
    <div class="page-break"></div>
    <div class="photo-section">
      <h6>Receipt DP</h6>
      <img src="{{ asset('storage/' . $event->receipt_dp) }}" alt="Receipt DP" width="100%">
    </div>
    @endif
    @if ($booking && $booking->receipt_full)
    <div class="page-break"></div>
    <div class="photo-section">
      <h6>Receipt Full</h6>
      <img src="{{ asset('storage/' . $booking->receipt_full) }}" alt="Receipt Full" width="100%">
    </div>
    @endif
    @if ($booking && $booking->ktp)
    <div class="page-break"></div>
    <div class="photo-section">
      <h6>KTP</h6>
      <img src="{{ asset('storage/' . $booking->ktp) }}" alt="KTP" width="100%">
    </div>
    @endif

  </div>
  <!--/ Content -->

  <script>
    window.onload = function() {
      window.print();
    };
  </script>
  <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/hammer/hammer.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
  
  <script src="{{asset('assets/vendor/js/menu.js')}}"></script>
  <!-- endbuild -->
  
  <!-- Vendors JS -->
  <script src="{{asset('assets/vendor/libs/shepherd/shepherd.js')}}"></script>
  <!-- Main JS -->
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>
