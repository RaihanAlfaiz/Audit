<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <title>Print Invoice - {{ $event->tenant_name }}</title>
  <style>
    * {
        -webkit-print-color-adjust: exact !important;
        color-adjust: exact !important;
    }
    table.table-bordered {
      border-color: #000!important;
    }
    table.table-bordered > thead > tr > th {
        padding-bottom: 5px!important;
        padding-top: 5px!important;
    }
    table.table-bordered tr th {
        border:1px solid black!important;
        padding-bottom: 0px!important;
        padding-top: 0px!important;
        border-color: #000;
    }
    table.table-bordered > tbody > tr > td {
        padding-bottom: 0px!important;
        padding-top: 0px!important;
        border-color: #000;
    }
    p {
      font-size: 14px!important;
      line-height: 16px!important;
    }
    li {
      font-size: 14px!important;
    }
    tr {
      font-size: 14px!important;
    }
    @media print {
      table.table-bordered {
        border-color: #000!important;
      }
      table.table-bordered > thead > tr > th {
          padding-bottom: 5px!important;
          padding-top: 5px!important;
      }
      table.table-bordered tr th {
          border:1px solid black!important;
          padding-bottom: 0px!important;
          padding-top: 0px!important;
          border-color: #000!important;
      }
      table.table-bordered > tbody > tr > td {
          padding-bottom: 0px!important;
          padding-top: 0px!important;
          border-color: #000!important;
      }
      p {
        font-size: 14px!important;
        line-height: 16px!important;
      }
      li {
        font-size: 14px!important;
      }
      tr {
        font-size: 14px!important;
      }
    }
  </style>
</head>
<body>
  <div class="container d-flex align-items-center">
    <div class="w-100">
      <img src="{{asset('assets/img/logo-jgu.png')}}" alt="" width="220">
    </div>
    <div class="w-50">
      {{-- <img src="{{asset('assets/img/logo-jgu.png')}}" alt="" width="150"> --}}
    </div>
    <div class="w-100 float-right d-flex flex-column justify text-right">
      <h3 class="">Auditorium <br> Jakarta Global University</h3>
      <p class="">Jl. Boulevard Grand Depok City, Tirtajaya, <br>Kec. Sukmajaya, Kota Depok, Jawa Barat 16412<br>Telp : 021 - ******</p>
    </div>
  </div>
  <div class="container">
    <hr style="height: 2px; background-color: black;">
  </div>

  <div class="container">
    <h4 class="font-weight-bold text-center"><u>I N V O I C E {{ strtoupper($event->tenant_name) }}</u></h4>

    <div class="d-flex justify-content-between">
      <div class="w-100">
        <div class="float-right">
          <table>
            <tr>
              <td>Date&emsp;:&emsp;</td>
              <td>{{ date('d-m-Y', strtotime($event->event_date)) }}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
    
    <div class="d-flex font-weight-bold">
      <div class="w-100 p-4 mr-3" style="border: 1px solid black;">
        <table>
          <tr>
            <td class="text-uppercase">Nama</td>
            <td class="">:</td>
            <td>{{ $event->tenant_name }}</td>
          </tr>
          <tr>
            <td class="text-uppercase">Alamat&emsp;</td>
            <td class="">:&emsp;</td>
            <td>{{ $event->Institution_origin }}</td>
          </tr>
        </table>
      </div>
      <div class="w-100 p-4" style="border: 1px solid black;">
        <table>
          <tr>
            <td class="text-uppercase">No handphone</td>
            <td class="">:</td>
            <td>{{ $event->phone }}</td>
          </tr>
          <tr>
            <td class="text-uppercase">Capacity</td>
            <td class="">:&emsp;</td>
            <td>{{ $event->capacity }}</td>
          </tr>
          <tr>
            <td class="text-uppercase">Package</td>
            <td class="">:&emsp;</td>
            <td>{{ $package->Name }}</td>
          </tr>
        </table>
      </div>
    </div>

    <div class="table-responsive mt-3">
      <table class="table table-bordered table-no-padding" style="border-color:#000;">
        <tr class="text-center text-uppercase">
          <th>No.</th>
          <th>Description</th>
          <th>Qty</th>
          <th>Unit Price</th>
          <th>Amount</th>
        </tr>
        @php
        $no = 1;
        $total_amount = 0;
        @endphp
        <tr>
          <td>{{ $no++ }}</td>
          <td>{{ $package->Name }} : {!! $package->service !!} {!! $package->item !!}</td>
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
        <tr style="border: 0px!important;">
          <td style="border: 0px!important;"></td>
          <td style="border: 0px!important;"></td>
          <td style="border: 0px!important;"></td>
          <td class="font-weight-bold">TOTAL</td>
          <td class="font-weight-bold">Rp&nbsp;{{ number_format($total_amount, 2, ',', '.') }}</td>
        </tr>

        <tr style="border: 0px!important;">
            <td style="border: 0px!important;"></td>
            <td style="border: 0px!important;"></td, ',', '.') }}</td>

        </tr>
        <!-- Informasi Pembayaran -->
        <tr style="border: 0px!important;">
          <td style="border: 0px!important;"></td>
          <td style="border: 0px!important;"></td>
          <td style="border: 0px!important;"></td>
          <td class="font-weight-bold">PEMBAYARAN</td>
          <td class="font-weight-bold">Rp&nbsp;{{ number_format($total_amount, 2, ',', '.') }}</td>
        </tr>
        <tr style="border: 0px!important;">
          <td style="border: 0px!important;"></td>
          <td style="border: 0px!important;"></td>
          <td style="border: 0px!important;"></td>
          <td class="font-weight-bold">SISA</td>
          <td class="font-weight-bold">Rp&nbsp; 0 (LUNAS)</td>
        </tr>
      </table>
    </div>
    
    <div class="d-flex justify-content-between align-items-end">
      <div class="w-100">
        <div class="p-2 mb-2" style="border: 1px solid black;">
            <p class="font-weight-bold">* Inovice ini berbentuk Digital, tidak memerlukan tanda tangan</p>
        </div>
      </div>
        <div class="w-100 text-center">
          <div class="w-50 float-right">
            <img src="https://s.jgu.ac.id/qrcode?data={{ route('booking.print', $encryptedId) }}&label=" alt="" class="ml-3" width="190px">


          
          </div>
        </div>
      </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7HfsFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    window.print()
  </script>
</body>
</html>
