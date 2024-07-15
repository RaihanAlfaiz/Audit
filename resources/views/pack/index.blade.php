@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/css/datatables.bootstrap5.css') }}">
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

<div class="card app-calendar-wrapper">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                    <a href="{{ route('package.create') }}" class="btn btn-primary mb-3"> Tambah Data</a>
                        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Package Name</th>
                                    <th>Service</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($package as $pck)
                    
                             <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $pck->Name }}</td>
                              <td>{!! $pck->service !!}</td>
                              <td>{!! $pck->item !!}</td>
                              <td>{{ 'Rp ' . number_format($pck->price, 0, ',', '.') }}</td>
                              <td class="text-center">
                                <a href="{{ route('package.show', $pck->id) }}" class="btn btn-sm btn-success "><i class='bx bx-detail' ></i></a>
                                <a href="{{ route('package.edit', $pck->id) }}" class="btn btn-sm btn-warning "><i class='bx bx-edit-alt' ></i></a>
                                <form action="{{ route('package.destroy', $pck->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger delete-btn "><i class='bx bx-trash' ></i></button>
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


@endsection

@section('script')
<script
src="https://demos.themeselection.com/sneat-bootstrap-html-laravel-admin-template/demo/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js">
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