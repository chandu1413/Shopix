{{-- @ extends('dashboard::admin.master') --}}
@extends('dashboard::adminlte.master')

@section('content-head')
<div class="row ">
    <div class="col-sm-6 ">
        <h3 class="mb-0">Users List</h3>
    </div>
    <div class="col-sm-6 d-flex justify-content-end">
        <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
       
    </div>
</div> <!--end::Row-->
<div class=" d-flex justify-content-start ">
     
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Users List
        </li>
    </ol>
</div> <!-- /.card-header -->
@endsection
@section('content')
    <div class="card mb-4">
    
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Created At</th>
                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
            @if($users->count() >0)
                    @foreach ($users as $user)
                    <tr>
                        <td><span class="small">{{ $user->id }}</span></td>
                        <td><small>{{ $user->name }}</small></td>
                        <td><small>{{ $user->email }}</small></td>
                        <td><small>{{ $user->roles->pluck('name')->implode(',') }}</small></td>
                        <td><small>{{ $user->created_at }}</small></td>
                        <td>
                            @if( $user->is_active == 1)
                            <span class="badge bg-success ">Active</span>
                            @else
                            <span class="badge bg-danger">In Active</span>
                            @endif
                        </td>
                        <td>
                            {{-- <button class="btn btn-primary" data-id="{{ $user->id }}">Edit</button> --}}

                            <a href="{{ route('users.edit', $user->id) }}"  class="btn btn-primary" >Edit</a>


                        </td>
                        <td>
                            <button class="btn btn-danger" data-id="{{ $user->id }}"
                                onclick="deleteUser (this)">Delete</button>
                            {{-- <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.ge tElementById('delete-form-{ { $user->id }}').submit(); }" class="btn btn-danger">Delete</a>

                        <form id="delete-form-{ { $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:none;">
                            @csrf
                            @ method('DELETE') <!-- Change this to DELETE -->
                        </form> --}}

                        </td>
                    </tr>
                @endforeach
                    
                </tbody>
            </table>
        </div> <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
                <li class="page-item"> <a class="page-link" href="#">&laquo;</a> </li>
                <li class="page-item"> <a class="page-link" href="#">1</a> </li>
                <li class="page-item"> <a class="page-link" href="#">2</a> </li>
                <li class="page-item"> <a class="page-link" href="#">3</a> </li>
                <li class="page-item"> <a class="page-link" href="#">&raquo;</a> </li>
            </ul>
        </div>
    </div> <!-- /.card -->

   
            
        @else
        
        <p class="m-3 text-center">No User Found.</p>

        @endif
  

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.deleteUser = function(e) {
                let id = e.dataset.id;

                // Get CSRF token
                let csrfToken = '{{ csrf_token() }}';

                $.ajax({
                    type: 'GET', // Use POST for delete actions
                    url: "{{ route('users.ajaxdestroy') }}",
                    data: {
                        id: id,
                        _token: csrfToken // Include CSRF token
                    },
                    success: function(data) {
                        alert(data.message);
                        location.reload();
                        // Optionally remove the user from the DOM
                        // $(e).closest('tr').remove(); // Assuming the user is in a table row
                    },
                    error: function(err) {
                        const error = JSON.parse(err.responseText).message;
                        $('.error').html(error);
                    }
                });
            };
        });
    </script>
@endsection
