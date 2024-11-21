@extends('dashboard::layouts.master')
@section('content')


    <a href="{{ route('roles.index') }}" class="btn btn-primary">Back</a>


    <div class="form-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf

            <h3 class="mb-3">Edit Role</h3>
            <label for="name">Name:</label>
            <input value="{{ $role->name }}" type="text" id="name" name="name">

            <div class=" row mt-2 mb-3">
                <h4 class="mt-3 mb-3 ">Select Permissions</h4>
                @if ($permissions->isNotEmpty())
                    @foreach ($permissions as $permission)
                        <div class="col-md-3">
                            <input {{ $hasPermission->contains($permission->name) ? 'checked' : '' }} class="rounded"
                                type="checkbox" value="{{ $permission->name }}" id="permission{{ $permission->id }}"
                                name="permissions[]">
                            <label for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                @endif

            </div>

            <button type="submit">Add</button>
        </form>
    </div>

@stop