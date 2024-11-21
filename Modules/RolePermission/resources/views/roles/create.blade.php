@extends('dashboard::layouts.master')
@section('content') 

        {{ __('Create') }}

        <a href="{{ route('roles.index') }}"
            class="bg-slate-700 text-sm rounded-md 
            text-white px-3 py-2">Back</a>

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
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf

                <h3>Create Role</h3>
                <label for="name">Name:</label>
                <input value="{{ old('name') }}" type="text" id="name" name="name">

                <div class="row m-3">
                    @if ($permissions->isNotEmpty())
                        @foreach ($permissions as $permission)
                            <div class="col-md-3 col-sm-3 m-2">
                                <input class="rounded" type="checkbox" value="{{ $permission->name }}"
                                    id="permission{{ $permission->id }}" name="permissions[]">
                                <label for="permission{{ $permission->id }}">{{ $permission->name }}</label>
                            </div>
                        @endforeach
                    @endif

                </div>

                <button type="submit">Add</button>
            </form>
        </div>
        
@stop