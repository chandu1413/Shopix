@extends('dashboard::layouts.master')
@section('content')
<div class="d-flex justify-content-between m-3">

    {{ __('roles List') }}

    <div><a href="{{ route('roles.create') }}" class="btn btn-primary">Create</a>
    <a href="{{ route('dashboard') }}" class="btn btn-warning">Back</a></div>
    </div>

    <div class="table-container">
        <h3>Sample Table</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->permissions->pluck('name')->implode(',') }}</td>
                        <td>
                            <div>
                                <a href="{{ route('roles.edit', $role->id) }}"
                                    class="btn btn-primary">Edit</a>
                            </div>

                        </td>
                        <td>
                            <div>

                                <a href="#"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this role?')) { document.getElementById('delete-form-{{ $role->id }}').submit(); }"
                                    class="btn btn-danger">Delete</a>

                                <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}"
                                    method="POST" style="display:none;">
                                    @csrf
                                    @method('DELETE') <!-- Change this to DELETE -->
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="my-3">
            {{ $roles->links() }}
        </div>
    </div>
@stop