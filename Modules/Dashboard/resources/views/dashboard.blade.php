@extends('dashboard::adminlte.master')


@section('content-head')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0"> {{ __('User Dashboard') }}</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Dashboard
                </li>
            </ol>
        </div>

    </div> <!--end::Row-->
@endsection
@section('content')
 <header class="d-flex justify-content-between align-items-center py-3">
    <h2 class="font-weight-semibold text-xl text-dark">
       
    </h2>
    {{-- <div>
        @can('view users')
            <a href="{{ route('users.index') }}" class="btn btn-slate-700 btn-sm">Users</a>
        @endcan
        @can('view roles')
            <a href="{{ route('roles.index') }}" class="btn btn-slate-700 btn-sm">Roles</a>
        @endcan
        @can('view permissions')
            <a href="{{ route('permission.index') }}" class="btn btn-slate-700 btn-sm">Permissions</a>
        @endcan
    </div> --}}
    {{-- <button class="checkin-btn" data-id="{{ Auth()->user()->id }}" onclick="attendance(this)">Check In</button> --}}
    {{-- <button class="{{ $attendance ? 'checkout-btn btn-danger' : 'checkin-btn' }}" 
        data-id="{{ Auth()->user()->id }}" 
        onclick="{{ $attendance ? 'checkout(this)' : 'attendance(this)' }}">
    {{ $attendance ? 'Check Out' : 'Check In' }}
    </button> --}}
    
</header> 
{{ __("You're logged in!") }} user Dashboard How R U


 
{{-- <script>
    document.addEventListener('DOMContentLoaded', function() {
        window.attendance = function(e) {
            let id = e.dataset.id;

            // Get CSRF token
            let csrfToken = '{{ csrf_token() }}';

            $.ajax({
                type: 'GET', // Use POST for delete actions
                url: "{{ route('attendance.ajaxCheckIn') }}",
                data: {
                    id: id,
                    _token: csrfToken // Include CSRF token
                },
                success: function(response) {
                    // Log the response for debugging
                    console.log(response);

                    // Change button to Check Out
                    $(e).text('Check Out');
                    $(e).removeClass('checkin-btn').addClass('checkout-btn'); // Change class for styling
                    $(e).css('background-color', 'red'); // Change button color to red
                    $(e).attr('onclick', 'checkout(this)'); // Update the onclick function for check out
                },
                error: function(err) {
                    const error = JSON.parse(err.responseText).message;
                    $('.error').html(error);
                }
            });
        };

        window.checkout = function(e) {
            let id = e.dataset.id;

            // Get CSRF token
            let csrfToken = '{{ csrf_token() }}';

            $.ajax({
                type: 'GET', // Use POST for delete actions
                url: "{{ route('attendance.ajaxCheckOut') }}", // Define your route for check out
                data: {
                    id: id,
                    _token: csrfToken // Include CSRF token
                },
                success: function(response) {
                    // Log the response for debugging
                    console.log(response);

                    // Change button back to Check In
                    $(e).text('Check In');
                    $(e).removeClass('checkout-btn').addClass('checkin-btn'); // Change class for styling
                    $(e).css('background-color', 'green'); // Change button color to green
                    $(e).attr('onclick', 'attendance(this)'); // Update the onclick function for check in
                },
                error: function(err) {
                    const error = JSON.parse(err.responseText).message;
                    $('.error').html(error);
                }
            });
        };
    });
</script> --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    window.attendance = function(e) {
        let id = e.dataset.id;
        let csrfToken = '{{ csrf_token() }}';

        $.ajax({
            type: 'GET',
            url: "{{ route('attendance.ajaxCheckIn') }}",
            data: {
                id: id,
                _token: csrfToken
            },
            success: function(response) {
                console.log(response);
                $(e).text('Check Out');
                $(e).removeClass('checkin-btn').addClass('checkout-btn');
                $(e).css('background-color', 'red');
                $(e).attr('onclick', 'checkout(this)');
            },
            error: function(err) {
                const error = JSON.parse(err.responseText).message;
                $('.error').html(error);
            }
        });
    };

    window.checkout = function(e) {
        let id = e.dataset.id;
        let csrfToken = '{{ csrf_token() }}';

        $.ajax({
            type: 'GET',
            url: "{{ route('attendance.ajaxCheckOut') }}",
            data: {
                id: id,
                _token: csrfToken
            },
            success: function(response) {
                console.log(response);
                $(e).text('Check In');
                $(e).removeClass('checkout-btn').addClass('checkin-btn');
                $(e).css('background-color', 'green');
                $(e).attr('onclick', 'attendance(this)');
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
