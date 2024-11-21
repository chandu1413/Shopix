<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RolesController extends Controller// implements HasMiddleware
{

    // public static function middleware() : array
    // {
    //     return[
    //         new Middleware('permission:view roles', only:['index']),
    //         new Middleware('permission:edit roles', only:['edit']),
    //         new Middleware('permission:create roles', only:['create']),
    //         new Middleware('permission:destroy roles', only:['destroy']),
    //     ];
    // }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::orderBy('name','ASC')->paginate(2);
        //  $permissions = Permission::all();
        return view('roles.index',[
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::orderBy('name','ASC')->get();

        return view('roles.create',[
            'permissions' => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        // dd($request->permissions);
        //  die;

        $validated = $request->validate([
            'name' => 'required|unique:roles|min:1',
        ]);
 
        
        $roles = Role::create(['name' => $request->name]);

        if(!empty($request->permissions)){
            foreach($request->permissions as $name ){
                $roles->givePermissionTo($name);
            }
        }


        return redirect()->route('roles.index')->with('status', 'Permission Has Been Created');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermission = $role->permissions->pluck('name');
        $permissions = Permission::orderBy('name','ASC')->get();
         
        if(!$role){
            return redirect()->back()->with('roles Not Found');
        }

        return view('roles.edit', [
            'role' => $role,
            'hasPermission' => $hasPermission,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    // Find the role by ID or fail
    $role = Role::findOrFail($id);

    // Validate the request
    $request->validate([
        'name' => 'required|string|unique:roles,name,' . $role->id // Ensure the name is unique except for the current role
    ]);

    // Update the role name
    $role->name = $request->name;

    // Sync permissions if provided
    if (!empty($request->permissions)) {
        $role->syncPermissions($request->permissions);
    } else {
        $role->syncPermissions([]);
    }

    // Save the role
    $role->save();

    // Redirect with success message
    return redirect()->route('roles.index')->with('status', 'Role updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if ($role) {
            $role->delete();
            return redirect()->back()->with('success', 'role deleted successfully.');
        }

        return redirect()->back()->with('error', 'role not found.');
    }

}
