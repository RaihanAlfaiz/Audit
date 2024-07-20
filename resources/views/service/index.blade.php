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
    .action-column {
        width: 150px; /* Sesuaikan lebar sesuai kebutuhan */
        white-space: nowrap; /* Mencegah teks melompat ke baris baru */
    }
</style>
@endsection
@section('content')

<div class="card app-calendar-wrapper">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
               
                <div class="card-body">
                    <a href="{{ route('service.create') }}" class="btn btn-primary mb-3"> Add Data</a>
                        <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th class="action-column">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                             @foreach ($service as $srv)
                             <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $srv->item }}</td>
                              <td>{{ $srv->unit }} {{ $srv->unit_name }}</td>
                              <td>Rp.{{ $srv->price }}</td>
                              <td class="text-center">
                              
                                <a href="{{ route('service.edit', $srv->id) }}" class="btn btn-sm btn-warning mb-3"><i class='bx bx-edit-alt' ></i></a>
                                <form action="{{ route('service.destroy', $srv->id) }}" method="POST" style="display: inline;">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger delete-btn mb-3"><i class='bx bx-trash' ></i></button>
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