@extends('layouts.master')
@section('breadcrumb-items')
<span class="text-muted fw-light">Events</span>
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/daterange-picker.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
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

    .action-column {
        width: 150px; /* Sesuaikan lebar sesuai kebutuhan */
        white-space: nowrap; /* Mencegah teks melompat ke baris baru */
    }
</style>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Reservasi</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $allevent }}</h4>
                        </div>
                        <small>Total Reservasi</small>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class='bx bxs-calendar'></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Diselesaikan</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $completevent }}</h4>
                            <small class="text-success">
                                ({{ $allevent > 0 ? round(($completevent / $allevent) * 100) . '%' : '0%' }})
                            </small>
                        </div>
                        <small>Reservasi yang Selesai </small>
                    </div>
                    <span class="badge bg-label-success rounded p-2">
                        <i class='bx bxs-calendar-check'></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-sm-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Auditorium</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $audit }}</h4>
                            <small class="text-success">
                                ({{ $allevent > 0 ? round(($audit / $allevent) * 100) . '%' : '0%' }})
                            </small>
                        </div>
                        <small>Reservasi Auditorium </small>
                    </div>
                    <span class="badge bg-label-primary rounded p-2">
                        <i class='bx bx-buildings'></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xxl-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between">
                    <div class="content-left">
                        <span>Lecture Theatre</span>
                        <div class="d-flex align-items-end mt-2">
                            <h4 class="mb-0 me-2">{{ $lecture }}</h4>
                            <small class="text-success">
                                ({{ $allevent > 0 ? round(($lecture / $allevent) * 100) . '%' : '0%' }})
                            </small>
                        </div>
                        <small>Reservasi Lecture Theatre </small>
                    </div>
                    <span class="badge bg-label-success rounded p-2">
                        <i class='bx bx-building' ></i>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-xl-6 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
              <div class="bg-label-primary rounded-3 text-center mb-4 pt-6">
                <img class="img-fluid" src="{{asset('assets/img/auditlebar.png')}}" alt="Card girl image" style="width: 100%;" />
              </div>
              <h5 class="mb-2">Auditroium Jakarta Global University</h5>
              <p>Dapatkan pengalaman tak terlupakan dengan fasilitas audio-visual terbaik di auditorium kami. Sempurna untuk konser, seminar, dan acara besar lainnya.</p>
              <div class="row mb-4 g-3">
                <div class="col-6">
                  <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary"><i class='bx bxs-user' ></i></i></span>
                    </div>
                    <div>
                        <h6 class="mb-0 text-nowrap">+1000 </h6>
                        <small>Capacity</small>
                    </div>
                  </div>
                </div>
              
              </div>
              <div class="col-12 text-center">
                <a href="{{ route('event.audit') }}" class="btn btn-primary w-100 d-grid">Join the event</a>
              </div>
            </div>
          </div>
    </div>
  
    <div class="col-12 col-xl-6 col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body">
              <div class="bg-label-primary rounded-3 text-center mb-4 pt-6">
                <img class="img-fluid" src="{{asset('assets/img/ltlebar.png')}}" alt="Card girl image" style="width: 100%;" />
              </div>
              <h5 class="mb-2">Lecture Theatre Jakarta Global University</h5>
              <p>Dengan fasilitas canggih dan suasana yang nyaman, lecture theatre kami adalah tempat ideal untuk kuliah, seminar, dan diskusi ilmiah</p>
              <div class="row mb-4 g-3">
                <div class="col-6">
                  <div class="d-flex align-items-center">
                    <div class="avatar flex-shrink-0 me-3">
                      <span class="avatar-initial rounded bg-label-primary"><i class='bx bxs-user' ></i></i></span>
                    </div>
                    <div>
                      <h6 class="mb-0 text-nowrap">+750 </h6>
                      <small>Capacity</small>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 text-center">
                <a href="{{ route('event.lecture') }}" class="btn btn-primary w-100 d-grid">Join the event</a>
              </div>
            </div>
          </div>
    </div>
  </div>

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
                   
                    <div class="table-responsive">
                        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tenant Name</th>
                                    <th>Phone</th>
                                    <th>Event Date</th>
                                    <th>Package</th>
                                    <th>Vendor</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                   
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
                                    <td>{{ $type_mapping[$ev->package->type] ?? $ev->package->type }}</td>
                                    @if($ev->package->pack == 'audit')
                                    <td>Auditroium</td>
                                    @else
                                    <td>LT Room</td>
                                    @endif
                                    <td><i class="badge rounded-pill bg-{{ $ev->color }}" style="font-size:10pt;">{{ $ev->status }}</i></td>
                                   
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
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
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

    $('#Select_1').on('change', function() {
        updateUrlParameter('package', $(this).val());
    });

    $('#Select_2').on('change', function() {
        updateUrlParameter('status', $(this).val());
    });

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const popupLinks = document.querySelectorAll('.popup-link');
        
        popupLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                const url = this.href;
                window.open(url, '_blank', 'width=900,height=600,scrollbars=yes,resizable=yes');
            });
        });
    });
</script>
@endsection
