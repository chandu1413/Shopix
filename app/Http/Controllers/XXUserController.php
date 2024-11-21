<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware 
{
    public static function middleware() : array
    {
        return[
            new Middleware('permission:view users', only:['index']),
            new Middleware('permission:edit users', only:['edit']),
            // new Middleware('permission:create roles', only:['create']),
            // new Middleware('permission:destroy roles', only:['destroy']),
        ];
    }
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::orderBy('name','ASC')->get();

        return view('users.create',[
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);


        $users = User::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'password' => $request->password,
        ]);

        return redirect()->route('users.index')->with('status', 'Permission Has Been Created');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users..show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name','ASC')->get();

        $hasRoles = $user->roles->pluck('id');

        if (!$user) {
            return redirect()->route('users.index')->with('Permission Not Found');
        }

        return view('users.edit', compact('user','roles','hasRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $id, // Ensure email is unique except for the current user
        'password' => 'nullable|string|min:6', // Make password nullable
        'role' => 'array' // Assuming roles is an array
    ]);

    // Find the user by ID
    $user = User::findOrFail($id);

    // Prepare the data to be updated
    $user->fill($request->only(['name', 'email'])); // Use fill for cleaner code

    // Check if the password is filled and hash it before updating
    if ($request->filled('password')) {
        $user->password = bcrypt($request->input('password')); // Hash the password
    }
    // dd($request->role);
    // die;
    // Sync roles
    if ($request->has('role')) {
        $user->syncRoles($request->role);
    }

    // Update the user with the data
    $user->save();

    // Redirect back to the users index with a success message
    return redirect()->route('users.index')->with('success', 'Updated successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $users = User::find($id);

        if ($users) {
            $users->delete();
            return redirect()->back()->with('success', 'Permission deleted successfully.');
        }

        return redirect()->back()->with('error', 'Permission not found.');
    }
}
