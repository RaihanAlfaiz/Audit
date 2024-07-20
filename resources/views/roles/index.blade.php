@extends('layouts.master')

@section('content')
<div class="card app-calendar-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Roles
                </div>

                <div class="card-body">
                
                    <button type="button" class="btn btn-md btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#basicModal">
                        Add Data
                      </button>
                
                    
                    <table id="tbl_role" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID Roles</th>
                                <th>Name Roles</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach ($roles as $role)
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                              <td>{{ $role->id }}</td>                                
                              <td> <i class="badge rounded-pill bg-{{ $role->color }}" style="font-size:8pt;">{{ $role->title }}</i></td>                                
                              <td>
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-success">Edit</a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger delete-btn">Hapus</button>
                              </form>
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
          <h5 class="modal-title" id="exampleModalLabel1">Masukan Data Role Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('roles.store') }}" method="POST">
          @csrf
            <div class="col mb-3">
              <label for="id" class="form-label">ID</label>
              <input type="text" id="id" class="form-control" name="id" placeholder="Enter id">
            </div>
            <div class="col mb-3">
                <label for="title" class="form-label">title</label>
                <input type="text" id="title" class="form-control" name="title" placeholder="Enter title">
              </div>
          </div>
        
    
        <div class="modal-footer">
          <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('script')
    @parent
    <script>
        $(document).ready(function(){
            $('#tbl_role').DataTable();

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
        var successMessage = '{{ session()->has('success') ? session('success') : '' }}';
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