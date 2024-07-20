@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />

@endsection
@section('content')
<div class="card app-calendar-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Add Data
                    </button>
                    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama </th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $u)
                            
                            <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $u->name }}</td>
                                    <td>{{ $u->email }}</td>
                                    <td>
                                        <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                            @foreach($u->roles as $role)
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up" title="{{ $role->title }}">
                                                    <i class="badge rounded-pill bg-{{ $role->color }}" style="font-size:8pt;">{{ $role->id }}</i>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        @if($u->status == 'accepted')
                                            <i class="badge rounded-pill bg-success" style="font-size:8pt;">{{ $u->status }}</i>
                                        @elseif($u->status == 'rejected')
                                            <i class="badge rounded-pill bg-danger" style="font-size:8pt;">{{ $u->status }}</i>
                                        @else
                                            <i class="badge rounded-pill bg-warning" style="font-size:8pt;">{{ $u->status }}</i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($u->status == 'pending')
                                        <form action="{{ route('profile.accepted', $u->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-success" name="status" value="accepted"><i class='bx bx-check'></i></button>
                                            <button type="submit" class="btn btn-sm btn-danger" name="status" value="rejected"><i class='bx bx-x'></i></button>
                                        </form>
                                        @else
                                        <a href="{{ route('profile.edit', $u->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('profile.destroy', $u->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete-btn">delete</button>
                                        </form>
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

<!-- Modal -->
<div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Tambah Data User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ url('profile') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter Name" name="name">
                        </div>
                    </div>
                    <div class="row g-2">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" placeholder="xxxx@xxx.xx" name="email">
                        </div>
                    </div>
                 
                    
                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="password" class="form-label">password</label>
                            <input type="password" id="password" class="form-control" placeholder="........." name="password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $(".select2").select2();
    });

</script>
    <script>
        $(document).ready(function(){
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
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });

        $(document).ready(function(){
        // Check if success message exists
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
