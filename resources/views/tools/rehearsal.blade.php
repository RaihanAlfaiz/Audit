@extends('layouts.master')
@section('css')
<style>
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
<div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-sm-row mb-4">
        <li class="nav-item"><a class="nav-link " href="{{ route('tools') }}"><i class='bx bxs-buildings'></i>
                Event Preparation</a></li>
        <li class="nav-item"><a class="nav-link active" href="{{ route('tools') }}"><i class='bx bxs-building' ></i>
            Rehearsals Preparation</a></li>
    </ul>
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
                                <th>Rehearsal Date</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->event->tenant_name }}</td>
                                <td>{{ $booking->event->package->Name }}</td>
                                <td>{{ date('d F Y', strtotime($booking->event->rehearsal_date)) }}</td>
                                <td>
                                    <i class="badge rounded-pill bg-{{ $booking->event->color }}" style="font-size:10pt;">{{ $booking->event->status }}</i>
                                </td>
                                <td>
                                    @if ($booking->event->status == 'rehearsal' || $booking->event->status == 'Complete')
                                        <i class="bx bx-check-circle" style="color: green; font-size: 1.5em;"></i>
                                    @else
                                        <a href="{{ route('tools.checklist.rehearsal', $booking->event->id) }}" class="btn btn-sm btn-primary">
                                            <i class='bx bx-chair'></i>
                                        </a>
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
@endsection

@section('script')
    @parent
    <script>
        $(document).ready(function(){
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
        });
    </script>
@endsection
