<x-app-layout>
    <x-slot name="header">
         <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div>
            @can('view users')
                <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md 
            text-white px-3 py-2">Users</a>
            @endcan
            @can('view roles')
                <a href="{{ route('roles.index') }}" class="bg-slate-700 text-sm rounded-md 
            text-white px-3 py-2">Roles</a>
            @endcan
            @can('view permissions')
            <a href="{{ route('permission.index') }}" class="bg-slate-700 text-sm rounded-md 
            text-white px-3 py-2">Permissions</a>
            @endcan
             
            </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
