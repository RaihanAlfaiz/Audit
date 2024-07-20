@extends('layouts.master')
@section('breadcrumb-items')
<span class="text-muted fw-light">Booking</span>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterange-picker.css') }}">
<link rel="stylesheet" href="assets/vendor/libs/bootstrap-select/bootstrap-select.css" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

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
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
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
                <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range" value="{{ request('range') ? request('range') : '' }}"/>
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
            <div class="col-md-3">
                <button class="btn btn-primary" id="resetFilters">Reset</button>
            </div>
        </div>
    </div>
</div>
<div class="card app-calendar-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tenant Name</th>
                                <th>Package</th>
                                <th>Event Date</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($booking as $bk)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $bk->event->tenant_name }}</td>
                                <td>{{ $bk->event->package->Name }}</td>
                                <td>{{ date('d F Y', strtotime($bk->event->event_date)) }}</td>
                                <td class="text-center"><i class="badge rounded-pill bg-{{ $bk->event->color }}" style="font-size:10pt;">{{ $bk->event->status }}</i></td>
                                <td class="text-center">
                                    <a href="{{ route('booking.print', Crypt::encryptString($bk->id)) }}" class="btn btn-sm btn-primary" target="_blank">
                                        <i class='bx bxs-printer'></i>
                                    </a>
                                </td>
                            </tr>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>

<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
<script src="assets/vendor/libs/bootstrap-select/bootstrap-select.js"></script>
<script>
    $(document).ready(function() {
        $('#tbl_list').DataTable();

        // Attach event listener for delete button click
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
                    Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                }
            });
        });

        // Check if success message exists
        var successMessage = '{{ session('success') }}';
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: successMessage,
                showConfirmButton: false,
                timer: 1500
            });
        }

      

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
        flatpickr("#flatpickr-range", {
        mode: "range",
        onChange: function(selectedDates, dateStr, instance) {
            if (selectedDates.length === 2) {
                var startDate = moment(selectedDates[0]).format('YYYY-MM-DD');
                var endDate = moment(selectedDates[1]).format('YYYY-MM-DD');
                updateUrlParameter('range', startDate + ' to ' + endDate);
            }
        }
    });
    

    $(".selectpicker").selectpicker();
});
</script>
<script>
    $('#resetFilters').on('click', function() {
    // Reset select options
    $('#Select_1').val('');
    $('#Select_1').selectpicker('refresh');
    $('#Select_2').val('');
    $('#Select_2').selectpicker('refresh');

    // Reset date range picker
    $('#flatpickr-range').flatpickr().clear();

    // Remove URL parameters and reload page
    var currentUrl = new URL(window.location.href);
    currentUrl.searchParams.delete('package');
    currentUrl.searchParams.delete('status');
    currentUrl.searchParams.delete('range');
    window.location.href = currentUrl.toString();
});
</script>
@endsection
