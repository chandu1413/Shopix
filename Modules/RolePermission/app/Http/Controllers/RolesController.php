<?php

namespace Modules\RolePermission\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RolesController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:destroy roles', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $user = Auth()->user();

        // Initialize the query for roles
        $rolesQuery = Role::where('name', '!=', 'superAdmin')
            ->where('guard_name', '!=', 'admin');

        // Check if the user has the 'bose' role
        if ($user->org_role === 'bose') {
            $rolesQuery->where('user_admin_id', $user->id);
        }

        // Execute the query and paginate results
        $roles = $rolesQuery->orderBy('name', 'ASC')->paginate(10);

        // Return the view with roles
        return view('rolepermission::roles.index', [
            'roles' => $roles,
        ]);
    }

    public function XXindex()
    {
        $roles = Role::orderBy('name', 'ASC');

        $user = Auth()->user();

        // dd( $user->org_role == 'bose');
        // die;

        if ($user->org_role == 'bose') {
            $roles->where('name', '!=', 'superAdmin')->where('guard_name', '!=', 'admin')->where('user_admin_id', $user->id)->paginate(10);
            return view('rolepermission::roles.index', [
                'roles' => $roles,
            ]);
        }


        $roles = Role::where('name', '!=', 'superAdmin')->where('guard_name', '!=', 'admin')->paginate(10);
        //  $permissions = Permission::all();
        return view('rolepermission::roles.index', [
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth()->user();

        if ($user->is_active == 1 && $user->org_role != 'bose' && $user->org_role != 'employee') {

            $permissions = Permission::orderBy('name', 'ASC')->get();

            return view('rolepermission::roles.create', [
                'permissions' => $permissions
            ]);
        }

        if ($user->org_role == 'bose') {
            $permissions = Permission::where('name', '!=', 'view permissions')
                ->where('name', '!=', 'create permissions')
                ->where('name', '!=', 'edit permissions')
                ->where('name', '!=', 'destroy permissions')
                ->orderBy('name', 'ASC')
                ->get();

            return view('rolepermission::roles.create', [
                'permissions' => $permissions
            ]);
        }

        return abort(403, 'You do not have permission to access this page.');
        // $permissions = Permission::orderBy('name', 'ASC')->get();


    }

    /**
     * Store a newly created resource in storage.
     */
    public function XXstore(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|unique:roles|min:1',
        ]);

        if (isset(Auth()->user()->org_role) == 'bose') {
            $user_admin_id  = Auth()->user()->id;
        }


        $roles = Role::create([
            'name' => $request->name,
            'user_admin_id'  => $user_admin_id,
        ]);

        if (!empty($request->permissions)) {
            foreach ($request->permissions as $name) {
                $roles->givePermissionTo($name);
            }
        }


        return redirect()->route('roles.index')->with('status', 'Permission Has Been Created');
    }


    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|unique:roles|min:1',
            'permissions' => 'array', // Ensure permissions is an array if provided
            'permissions.*' => 'string' // Validate each permission as a string
        ]);

        // Initialize user_admin_id to null
        $user_admin_id = null;

        // Check if the user's role is 'bose' and set user_admin_id accordingly
        if (Auth()->user()->org_role === 'bose') {
            $user_admin_id = Auth()->user()->id;
        }

        // Create the new role
        $role = Role::create([
            'name' => $validated['name'],
            'user_admin_id' => $user_admin_id,
        ]);

        // Assign permissions if provided
        if (!empty($validated['permissions'])) {
            foreach ($validated['permissions'] as $permission) {
                // Ensure the permission exists before assigning
                if (is_string($permission)) {
                    $role->givePermissionTo($permission);

                    // $permission_data = new Permission;

                }
            }
        }

        // Redirect back to roles index with a success message
        return redirect()->route('roles.index')->with('status', 'Permission Has Been Created');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('rolepermission::roles.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $hasPermission = $role->permissions->pluck('name');

        if (!$role) {
            return redirect()->back()->with('roles Not Found');
        }

        $user = Auth()->user();

        if ($user->is_active == 1 && $user->org_role != 'bose' && $user->org_role != 'employee') {

            $permissions = Permission::orderBy('name', 'ASC')->get();

            return view('rolepermission::roles.edit', [
                'role' => $role,
                'hasPermission' => $hasPermission,
                'permissions' => $permissions,
            ]);
        }

        // $permissions = Permission::orderBy('name', 'ASC')->get();


        if ($user->org_role == 'bose' && $user->org_role != 'employee') {
            $permissions = Permission::where('name', '!=', 'view permissions')
                ->where('name', '!=', 'create permissions')
                ->where('name', '!=', 'edit permissions')
                ->where('name', '!=', 'destroy permissions')
                ->orderBy('name', 'ASC')
                ->get();

            return view('rolepermission::roles.edit', [
                'role' => $role,
                'hasPermission' => $hasPermission,
                'permissions' => $permissions,
            ]);
        }

        return abort(403, 'You do not have permission to access this page.');

        // return view('rolepermission::roles.edit', [
        //     'role' => $role,
        //     'hasPermission' => $hasPermission,
        //     'permissions' => $permissions,
        // ]);
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
