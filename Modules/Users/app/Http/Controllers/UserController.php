<?php

namespace Modules\Users\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Modules\Company\Models\Company;
use Modules\Company\Models\Department;
use Modules\Users\Interfaces\UserServiceInterface;
use Modules\Users\Models\UserDepartment;

class UserController extends Controller implements HasMiddleware
{
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit']),
            new Middleware('permission:create users', only: ['create']),
            new Middleware('permission:destroy users', only: ['destroy']),
        ];
    }

    public function index()
    {
        $authUser = Auth::user();


        $auth_user_id = $authUser->id;

        if ($authUser->org_role == 'employee') {
            return abort(403, 'You do not have permission to access this page.');
        }

        // Check if the authenticated user is an admin
        if ($auth_user_id === 1 && $authUser->is_admin === 1) {
            // If the user is an admin, fetch all users
            $users = User::latest()->paginate(10);
        } else {
            // If the user is not an admin, fetch only non-admin users
            $users = User::where('is_admin', '!=', 1)->where('created_by_user_id', $auth_user_id)->latest()->paginate(10);
        }
        return view('users::users.index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Start the query for roles
        $rolesQuery = Role::orderBy('name', 'ASC');
        $user = Auth::user();



        // Check if the user is associated with a company
        if (!$user->company) {
            return redirect()->route('company.create')->with('error', 'Please add the Company to add  users');
        }
        if ($user->org_role == 'employee') {
            return abort(403, 'You do not have permission to access this page.');
        }
        // if($user)
        // dd($user->org_role == 'bose');
        // die;

        $user_company_id = $user->company->id;

        // Get departments associated with the user
        $departmentsQuery = Department::where('admin_id', $user->id)
            ->where('company_id', $user_company_id);

        $departments = $departmentsQuery->get();

        if ($departments->count() == 0) {
            return redirect()->route('department.index')->with('error', 'Please add Department first');
        }

        // Check if the user is an active admin
        if ($user->is_admin == 1 && $user->is_active == 1) {
            // Admin can see all roles
            $roles = $rolesQuery->get();
        } else {
            // Non-admins see only specific roles
            $roles = $rolesQuery->where('guard_name', '!=', 'admin')
                ->where('name', '!=', 'admin')
                ->where('user_admin_id', $user->id)
                ->get();
        }

        if ($roles->count() == 0) {
            return redirect()->route('roles.index')->with('error', 'Please add Role to assign to user');
        }

        return view('users::users.create', [
            'roles' => $roles,
            'departments' => $departments,
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

        // Check if roles are provided and sync them
        if ($request->has('role')) {
            $users->syncRoles($request->role); // Sync the roles
        }

        return redirect()->back()->with('status', 'Permission Has Been Created');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function ajaxStore(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|unique:users|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|confirmed', // Assuming a confirmation field
            'department' => 'required|exists:departments,id' // Validate that the department exists
        ]);

        // Create the user with a hashed password
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Hash the password
            'created_by_user_id' => Auth::id(), // Get the ID of the authenticated user
            'org_role' => 'employee'
        ]);

        // If a department is provided, create a record in UserDepartment
        if ($request->has('department')) {
            UserDepartment::create([
                'user_id' => $user->id, // Use the newly created user's ID
                'department_id' => $request->input('department')
            ]);
        }

        // Check if roles are provided and sync them
        if ($request->has('role')) {
            $user->syncRoles($request->role); // Sync the roles
        }

        // Return a JSON response indicating success
        return response()->json(['success' => 'User  created successfully.']);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        // Attempt to find the user; if not found, redirect early
        $user = User::findOrFail($id);

        $authUser = Auth::user();

        if ($authUser->org_role == 'employee') {
            return abort(403, 'You do not have permission to access this page.');
        }

        // Start the query for roles
        $rolesQuery = Role::orderBy('name', 'ASC');

        // Check if the user is an active admin
        if ($authUser->is_admin && $authUser->is_active) {
            // Admin can see all roles
            $roles = $rolesQuery->get();
        } else {
            // Non-admins see only specific roles
            $roles = $rolesQuery->where('guard_name', '!=', 'admin')
                ->where('name', '!=', 'admin')
                ->where('user_admin_id', $authUser->id)
                ->get();
        }

        // Get the roles the user has
        $hasRoles = $user->roles->pluck('id');

        return view('users::users.edit', compact('user', 'roles', 'hasRoles'));
    }


    public function XXedit($id)
    {
        // Start the query for roles
        $rolesQuery = Role::orderBy('name', 'ASC');

        $authUser = Auth()->user();

        // Check if the user is an active admin
        if ($authUser->is_admin == 1 && $authUser->is_active == 1) {
            // Admin can see all roles
            $roles = $rolesQuery->get();
        } else {
            // Non-admins see only specific roles
            $roles = $rolesQuery->where('guard_name', '!=', 'admin')
                ->where('name', '!=', 'admin')
                ->where('user_admin_id', $authUser->id)
                ->get();
        }

        // Auth()->user>Role->id;
        $user = User::findOrFail($id);
        // dd(Auth()->user());
        // dd($user->role);
        // die;
        // $roles = Role::where('guard_name','!=','admin')->orderBy('name', 'ASC')->get();

        $hasRoles = $user->roles->pluck('id');

        if (!$user) {
            return redirect()->route('users.index')->with('Permission Not Found');
        }

        return view('users::users.edit', compact('user', 'roles', 'hasRoles'));
    }


    // public function ajaxEdit(Request $request)
    // {
    //     echo $request;
    //     die;
    //     $user = User::findOrFail($id);
    //     $roles = Role::orderBy('name','ASC')->get();

    //     $hasRoles = $user->roles->pluck('id');

    //     if (!$user) {
    //         return redirect()->route('users.index')->with('Permission Not Found');
    //     }

    //     return view('users::users.edit', compact('user','roles','hasRoles'));
    // }

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
    public function dsestroy($id)
    {
        $users = User::find($id);

        if ($users) {
            $users->delete();
            return redirect()->back()->with('success', 'Permission deleted successfully.');
        }

        return redirect()->back()->with('error', 'Permission not found.');
    }



    public function ajaxDestroy(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'id' => 'required|exists:users,id', // Ensure the ID is present and exists in the users table
        ]);

        $id = $request->id;

        try {
            $user = User::findOrFail($id); // This will throw a ModelNotFoundException if not found
            $user->delete();

            return response()->json(['message' => 'User  deleted successfully.'], 200); // 200 OK
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'User  not found.'], 404); // 404 Not Found
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the user.'], 500); // 500 Internal Server Error
        }
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:5',
        ]);

        try {
            // Delegate user creation to the service
            $user = $this->userService->createUser($validatedData);

            // Return a success response (you can customize the response as needed)
            return response()->json([
                'success' => true,
                'message' => 'User registered successfully!',
                'user' => $user,  // Optionally, return the created user
            ], 201);
        } catch (\Exception $e) {
            // If there's an error (e.g., database issue), return an error response
            return response()->json([
                'success' => false,
                'message' => 'An error occurred during registration.',
            ], 500);
        }
    }
}
