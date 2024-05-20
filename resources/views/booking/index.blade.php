@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-body">
                   
                    <table id="tbl_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>tenant Name</th>
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
                             <td> <i class="badge rounded-pill bg-{{ $bk->event->color }}" style="font-size:10pt;">{{ $bk->event->status }}</i></td>  
                             <td>
                              <a href="" class="btn btn-sm btn-primary"><i class='bx bxs-file-pdf'></i></a>
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
