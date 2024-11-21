{{-- @ extends('dashboard::admin.master') --}}
@extends('dashboard::adminlte.master')
@section('content')






    <div class="card card-info card-outline mb-4"> <!--begin::Header-->
        <div class="card-header">
            <div class="card-title">Edit User</div>
        </div> <!--end::Header--> <!--begin::Form-->
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="needs-validation" novalidate>
            @csrf

            <div class="card-body"> <!--begin::Row-->
                <div class="row g-3 p-4"> <!--begin::Col-->
                    <div class="col-md-4"> <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                            required>
                        <div class="valid-feedback">Looks good!</div>
                    </div> <!--end::Col--> <!--begin::Col-->
                    <div class="col-md-4"> <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}"
                            required>
                        <div class="valid-feedback">Looks good!</div>
                    </div> <!--end::Col--> <!--begin::Col-->
                    <div class="col-md-4"> <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" value="" required>
                        <div class="valid-feedback">Looks good!</div>
                    </div> <!--end::Col--> <!--begin::Col-->

                    @if ($roles->isNotEmpty())
                        @foreach ($roles as $role)
                            <div class="col-4">
                                <div class="form-check">
                                    <input {{ $hasRoles->contains($role->id) ? 'checked' : '' }} class="form-check-input"
                                        type="checkbox" id="role-{{ $role->id }}" value="{{ $role->name }}"
                                        name="role[]">
                                    <label class="form-check-label" for="role-{{ $role->id }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            </div> <!--end::Col-->
                        @endforeach
                    @endif

                </div> <!--end::Row-->
            </div> <!--end::Body--> <!--begin::Footer-->
            <div class="card-footer">
                <button class="btn btn-info" type="submit">Submit form</button>
            </div> <!--end::Footer-->
        </form> <!--end::Form--> <!--begin::JavaScript-->

    </div> <!--end::Form Validation-->
@endsection
