<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionsController extends Controller // implements HasMiddleware
{
    // public static function middleware() : array
    // {
    //     return[
    //         new Middleware('permission:view permissions', only:['index']),
    //         new Middleware('permission:edit permissions', only:['edit']),
    //         new Middleware('permission:create permissions', only:['create']),
    //         new Middleware('permission:destroy permissions', only:['destroy']),
    //     ];
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $permissions = Permission::all();
        return view('permissions.index',[
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:permissions|max:255',
        ]);

        // #nre
        // $Permission $permission
        // $validated = new Permission; 
        // $validated->name = $request->name;
        
        // $role->save();

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
            ]);

        return redirect()->route('permission.index')->with('status', 'Permission Has Been Created');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('permissions..show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        
        if(!$permission){
            return redirect()->route('permission.index')->with('Permission Not Found');
        }

        return view('permissions.edit', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'description' => 'nullable|string|max:255',
            // Add other validation rules as needed
        ]);
        // return $request->name;

        $permission = Permission::find($id)->update([
            'name'=>$request->name,
        ]);
        return redirect()->route('permission.index')->with('Updated sucessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    $permission = Permission::find($id);

    if ($permission) {
        $permission->delete();
        return redirect()->back()->with('success', 'Permission deleted successfully.');
    }

    return redirect()->back()->with('error', 'Permission not found.');
}

}
