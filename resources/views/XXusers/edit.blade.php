<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit user') }}
            </h2>
            <div>
                 
                <a href="{{ route('users.index') }}" class="bg-slate-700 text-sm rounded-md 
                text-white px-3 py-2">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <style>
       

                        .form-container {
                            max-width: 400px;
                            margin: auto;
                            background: white;
                            padding: 20px;
                            border-radius: 5px;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        }
                        
                        form {
                            display: flex;
                            flex-direction: column;
                        }
                        
                        label {
                            margin-bottom: 5px;
                            font-weight: bold;
                        }
                        
                        input[type="text"],
                        textarea {
                            margin-bottom: 15px;
                            padding: 10px;
                            border: 1px solid #ccc;
                            border-radius: 4px;
                        }
                        
                        button {
                            padding: 10px;
                            background-color: #28a745;
                            color: white;
                            border: none;
                            border-radius: 4px;
                            cursor: pointer;
                        }
                        
                        button:hover {
                            background-color: #218838;
                        }
                            </style>    
                        <div class="form-container">
                            <form method="POST" action="{{route('users.update',$user->id)}}" >
                             @csrf
                                  
                                <label for="name">Name:</label>
                                <input value="{{  $user->name  }}" type="text" id="name" name="name"  >
                                <label for="email">Email:</label>
                                <input value="{{  $user->email  }}" type="text" id="email" name="email"  >
                                <label for="password">Password:</label>
                                <input   placeholder="password" type="text" id="password" name="password"  >
                                <div class="grid grid-cols-2 mb-3">
                                    @if($roles->isNotEmpty())
                                        @foreach($roles as $role)
                                        <div class="mt-3">
                                            <input {{$hasRoles->contains($role->id) ? 'checked': ''}} type="checkbox" name="role[]" id="role-{{$role->id}}" value="{{ $role->name }}"
                                            class="rounded">
                                            {{-- <input { {$hasPermission->contains($permission->name) ? 'checked': ''}} class="rounded" type="checkbox" value="{{ $permission->name }}" id="permission{{$permission->id}}"  name="permissions[]"> --}}
                                            <label for="role-{{$role->id}}">{{ $role->name }}</label>
                                        </div>
                                        @endforeach
                                    @endif
                                    
                                </div>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                            </div>
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>




{{-- 
    <style>
 
.form-container {
    max-width: 400px;
    margin: auto;
    background: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

form {
    display: flex;
    flex-direction: column;
}

label {
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
textarea {
    margin-bottom: 15px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    padding: 10px;
    background-color: #28a745;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #218838;
}
    </style> --}}
