{{-- @ extends('dashboard::admin.master') --}}
@extends('dashboard::adminlte.master')

@section('content-head')
<div class="row ">
    <div class="col-sm-6 ">
        <h3 class="mb-0">Customers ({{$total}})</h3>
    </div>
    <div class="col-sm-6 d-flex justify-content-end">
        <a href="{{route('users.create')}}" class="btn btn-primary">Create</a>
       
    </div>
</div> <!--end::Row-->
<div class=" d-flex justify-content-start ">
     
    <ol class="breadcrumb float-sm-end">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">
            Customers List
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
                        <th>Mobile No</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Profile Photo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
            @if($total > 0)
                    @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer['id'] }}</td>
                        <td>{{ $customer['name'] }}</td>
                        <td>{{ $customer['email'] }}</td>
                        <td>{{ $customer['mobile_no'] }}</td>
                        <td>
                            @if( $customer->is_active == 1)
                            <span class="badge bg-success ">Active</span>
                            @else
                            <span class="badge bg-danger">In Active</span>
                            @endif
                        </td>
                        <td>{{ $customer['created_at'] }}</td>
                        <td>
                            <img src="{{ $customer['profile_photo_url'] }}" alt="Profile Photo" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                            <a href="{{ route('users.edit', $customer['id']) }}" class="btn btn-primary">Edit</a>
                            <button class="btn btn-danger" data-id="{{ $customer['id'] }}" onclick="deleteUser  (this)">Delete</button>
                        </td>
                    </tr>
                         
                @endforeach
                    
                </tbody>
            </table>
        </div> 
        <!-- /.card-body -->
        <div class="card-footer clearfix">
             {{-- Pagination Links --}}
    <div>
        <span>Page {{ $current_page }} of {{ $last_page }}</span>
        <div>
            @if($current_page > 1)
                <a href="{{ route('your.route', ['page' => $current_page - 1]) }}">Previous</a>
            @endif

            @if($current_page < $last_page)
                <a href="{{ route('your.route', ['page' => $current_page + 1]) }}">Next</a>
            @endif
        </div>
    </div>
            
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
