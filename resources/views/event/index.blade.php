@extends('layouts.master')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterange-picker.css')}}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />

<style>
    .project-list .row {
        margin: 15px;
    }

    .project-list button:focus {
        outline: none !important;
    }

    .project-list .theme-form .form-group {
        margin-bottom: 15px;
    }

    .project-list .border-tab.nav-tabs .nav-item .nav-link {
        border: 1px solid transparent;
        padding: 5px 30px 5px 0;
        border-radius: 5px;
        display: flex;
        align-items: center;
    }

    .project-list .btn {
        margin-right: 5px;
        vertical-align: -12px;
        float: right;
    }

    .project-list .btn svg {
        vertical-align: middle;
        height: 16px;
    }

    .project-list ul {
        margin-bottom: 0 !important;
        border-bottom: 0;
    }

    .project-list ul li svg {
        height: 18px;
        vertical-align: middle;
        margin-right: 5px;
    }

    .table {
        font-size: 12px;
    }

    .table th, .table td {
        padding: 5px;
    }

    .table th {
        white-space: nowrap;
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>
@endsection

@section('content')
<div class="col-md-12 project-list mb-3">
    <div class="card">
        <div class="row">
            <div class="col-md-3">
                <input class="form-control" id="select_range" type="text" placeholder="Select Date" autocomplete="off" value="{{ request('range') }}">
            </div>
            <div class="col-md-3">
                <select id="Select_1" class="selectpicker w-100" data-style="btn-default" data-live-search="true">
                    <option value="">Package</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" {{ request('package') == $package->id ? 'selected' : '' }}>{{ $package->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="Select_2" class="selectpicker w-100" data-style="btn-default" data-live-search="true">
                    <option value="">Select Status</option>
                    <option value="Complete" {{ request('status') == 'Complete' ? 'selected' : '' }}>Complete</option>
                    <option value="DP" {{ request('status') == 'DP' ? 'selected' : '' }}>DP</option>
                    <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Process" {{ request('status') == 'Process' ? 'selected' : '' }}>Process</option>
                    <option value="Success" {{ request('status') == 'Success' ? 'selected' : '' }}>Success</option>
                    <option value="Ready" {{ request('status') == 'Ready' ? 'selected' : '' }}>Ready</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="card app-calendar-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                {{-- <div class="card-header"></div> --}}
                <div class="card-body">
                    <a href="{{ route('event.create') }}" class="btn btn-primary mb-3">Tambah Data</a>
                    <div class="table-responsive">
                        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tenant Name</th>
                                    <th>Phone</th>
                                    <th>Event Date</th>
                                    <th>Package</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event as $ev)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $ev->tenant_name }}</td>
                                    <td>{{ $ev->phone }}</td>
                                    <td>{{ date('d F Y', strtotime($ev->event_date)) }}</td>
                                    <td>{{ $ev->package->Name }}</td>
                                    <td><i class="badge rounded-pill bg-{{ $ev->color }}" style="font-size:10pt;">{{ $ev->status }}</i></td>
                                    <td>
                                        <a href="{{ route('event.show' , $ev->id) }}" class="btn btn-sm btn-success">Detail</a>
                                        <a href="{{ route('event.edit', $ev->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('event.destroy', $ev->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">Hapus</button>
                                        </form>
                                        @if($ev->receipt_dp && $ev->bookings->isEmpty())
                                        <a href="{{ route('booking.create', $ev->id) }}" class="btn btn-sm btn-primary">BOOKING</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@parent
<script src="{{ asset('assets/js/datepicker/daterange-picker/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/daterange-picker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
<script>
$(document).ready(function() {
    $('#tbl_list').DataTable();

    $('.delete-btn').click(function(event) {
        event.preventDefault();
        var form = $(this).closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                );
            }
        });
    });

    var successMessage = '{{ session('success') }}';
    if(successMessage){
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: successMessage,
            showConfirmButton: false,
            timer: 1500
        });
    }

    var start = null;
    var end = null;
    var start_prev = null;
    var end_prev = null;

    if(moment().format('M') >= 3 && moment().format('M') <= 8){ 
        start = moment().month(2).startOf('month'); 
        end = moment().month(7).endOf('month'); 
        start_prev = moment().month(8).subtract(1, 'year').startOf('month');
        end_prev = moment().month(1).endOf('month');
    } else { 
        if(moment().format('M') > 8){
            start = moment().month(8).startOf('month'); 
            end = moment().month(1).add(1, 'Y').endOf('month'); 
            start_prev = moment().month(2).startOf('month'); 
            end_prev = moment().month(7).endOf('month'); 
        } else {
            start = moment().month(8).subtract(1, 'year').startOf('month'); 
            end = moment().month(1).endOf('month'); 
            start_prev = moment().month(2).subtract(1, 'year').startOf('month'); 
            end_prev = moment().month(7).subtract(1, 'year').endOf('month'); 
        }
    };

    $('#select_range').daterangepicker({
        startDate: start,
        endDate: end,
        locale: {
            format: 'YYYY-MM-DD'
        },
        ranges: {
            'Today': [moment(), moment()],
            'This Semester': [start, end],
            'Previous semester': [start_prev, end_prev],
            'All': [moment("2020-01-01T00:00:00"), end],
        }
    }, function(start, end) {
        updateUrlParameter('range', start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
    });

    $('#Select_1').on('change', function() {
        updateUrlParameter('package', $(this).val());
    });

    $('#Select_2').on('change', function() {
        updateUrlParameter('status', $(this).val());
    });

    function updateUrlParameter(param, value) {
        var currentUrl = new URL(window.location.href);
        var searchParams = currentUrl.searchParams;

        if (value) {
            searchParams.set(param, value);
        } else {
            searchParams.delete(param);
        }

        currentUrl.search = searchParams.toString();
        window.location.href = currentUrl.toString();
    }

    $(".selectpicker").selectpicker();
});
</script>
@endsection
