<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions List') }}
        </h2>
        <div>
            <a href="{{ route('permission.create') }}" class="bg-slate-700 text-sm rounded-md 
            text-white px-3 py-2">Create</a>
            <a href="{{ route('dashboard') }}" class="bg-slate-700 text-sm rounded-md 
            text-white px-3 py-2">Back</a>
        </div>
    </div>
        <style>
            body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        .table-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
        }
        
        th {
            background-color: #f2f2f2;
        }
        
        tr:hover {
            background-color: #f1f1f1;
        }
        
        button {
            padding: 5px 10px;
            margin-right: 5px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        button:hover {
            background-color: #0056b3;
        }
        </style>
        
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    
<div class="table-container">
    <h3>Sample Table</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                {{-- <th>Description</th> --}}
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
            <tr>
                <td>{{$permission->id}}</td>
                <td>{{$permission->name}}</td>
                {{-- <td>{{$permission->description}}</td> --}}
                <td>
                    <div>
                        <a href="{{ route('permission.edit', $permission->id) }}"  class="bg-slate-700 text-sm rounded-md 
            text-white px-3 py-3" >Edit</a>
                    </div>
                    
                </td>
                <td>
                    <div>
                         
                        <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this permission?')) { document.getElementById('delete-form-{{ $permission->id }}').submit(); }" class="bg-slate-700 text-sm rounded-md text-white px-3 py-3">Delete</a>

                        <form id="delete-form-{{ $permission->id }}" action="{{ route('permission.destroy', $permission->id) }}" method="POST" style="display:none;">
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
         
            {{-- { {$permissions->links()}} --}}
        
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>


 

