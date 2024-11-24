 {{-- @ extends('dashboard::admin.master') --}}
 @extends('dashboard::adminlte.master')
 
 @section('content')

     <div class="form-container">
         {{-- @i f ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @ endif --}}
         <div class="d-flex justify-content-between m-3">
             <h3>Create User</h3>
             <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
         </div>

         <div class="alert alert-danger print-error-msg" style="display:none">
             <ul></ul>
         </div>
         <form method="POST" action="{{ route('users.ajaxStore') }}" id="ajax-form">
             @csrf
             <div class="row">
                 <div class="col-md-6">
                     <label for="name">Name:</label>
                     <input value="{{ old('name') }}" type="text" id="name" name="name" required>
                 </div>
                 <div class="col-md-6">
                     <label for="email">Email:</label>
                     <input value="{{ old('email') }}" type="email" id="email" name="email" required>
                 </div>
                 <div class="col-md-6">
                     <label for="password">Password:</label>
                     <input value="{{ old('password') }}" type="password" id="password" name="password" required>
                 </div>
                 <div class="col-md-6">
                    <label for="password">Conform Password:</label>
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                 
                 <div class="col-md-6">
                    <label for="department">Department</label>
                    <select name="department" id="department">
                        <option disabled selected value=""></option>
                       {{-- @ foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->name}}</option>
                        @ endforeach --}}
                    </select>
                 </div>

             </div>







             <div class="grid grid-cols-2 mb-3">
                 @if ($roles->isNotEmpty())
                     @foreach ($roles as $role)
                         <div class="mt-3">
                             <input type="checkbox" name="role[]" id="role-{{ $role->id }}" value="{{ $role->name }}"
                                 class="rounded">
                             <label for="role-{{ $role->id }}">{{ $role->name }}</label>
                         </div>
                     @endforeach
                 @endif
             </div>

             <button type="submit">Add</button>
         </form>
     </div>

     <script type="text/javascript">
         /*------------------------------------------
             --------------------------------------------
             Form Submit Event
             --------------------------------------------
             --------------------------------------------*/
         $('#ajax-form').submit(function(e) {
             e.preventDefault();

             var url = $(this).attr("action");
             let formData = new FormData(this);

             $.ajax({
                 type: 'POST',
                 url: url,
                 data: formData,
                 contentType: false,
                 processData: false,
                 success: (response) => {
                     alert('User created successfully.');
                     location.reload(); // Reload the page to see the updated list
                 },
                 error: function(response) {
                     $('#ajax-form').find(".print-error-msg").find("ul").html('');
                     $('#ajax-form').find(".print-error-msg").css('display', 'block');
                     $.each(response.responseJSON.errors, function(key, value) {
                         $('#ajax-form').find(".print-error-msg").find("ul").append('<li>' +
                             value[0] + '</li>');
                     });
                 }
             });
         });
     </script>
 @endsection
