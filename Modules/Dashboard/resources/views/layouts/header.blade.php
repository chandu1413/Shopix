<header class="d-flex justify-content-between align-items-center py-3">
    <h2 class="font-weight-semibold text-xl text-dark">
        {{ __('User Dashboard') }}
    </h2>
    <div>
        @can('view users')
            <a href="{{ route('users.index') }}" class="btn btn-slate-700 btn-sm">Users</a>
        @endcan
        @can('view roles')
            <a href="{{ route('roles.index') }}" class="btn btn-slate-700 btn-sm">Roles</a>
        @endcan
        @can('view permissions')
            <a href="{{ route('permission.index') }}" class="btn btn-slate-700 btn-sm">Permissions</a>
        @endcan
    </div>
</header>