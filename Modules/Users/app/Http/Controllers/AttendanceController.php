<?php

namespace Modules\Users\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Models\Attendance;

class AttendanceController extends Controller
{

    // In your controller method that serves the view
    // public function yourViewMethod()
    // {
    //     $user = Auth::user();
    //     $attendance = Attendance::where('user_id', $user->id)->whereNull('check_out')->latest()->first();

    //     return view('your.view', [
    //         'attendance' => $attendance,
    //     ]);
    // }

    public function ajaxCheckIn(Request $request)
    {
        $user_id = Auth()->user()->id;

        // Get the admin ID if the user was created by another user
        $user_admin_id = Auth()->user()->created_by_user_id ?? null;

        try {
            // Ensure the user is checking in themselves
            if ($user_id == $request->id) {
                // Fetch the user (corrected the query)
                $user = User::find($request->id); // Use find() instead of where() for simplicity

                // Create attendance record
                $attendance = Attendance::create([
                    'user_id' => $user_id,
                    'check_in' => Carbon::now(),
                    'user_admin_id' => $user_admin_id, // Set user_admin_id here
                ]);

                // Optionally, you can also handle the case where user_admin_id is not set
                // if ($user_admin_id) {
                //     $attendance->user_admin_id = $user_admin_id;
                //     $attendance->save();
                // }
            }
        } catch (Exception $exp) {
            return response()->json(['error' => $exp->getMessage()], 500);
        }

        return response()->json([
            'userId' => $user_id,
            'user' => $user,
            'message' => 'User  Check In Successfully'
        ]);
    }


    public function ajaxCheckOut(Request $request)
    {
        $user_id = Auth()->user()->id;

        try {
            // Ensure the user is checking out themselves
            if ($user_id == $request->id) {
                // Find the latest attendance record for the user that does not have a check-out time
                $attendance = Attendance::where('user_id', $user_id)
                    ->whereNull('check_out') // Ensure we're checking out the correct record
                    ->latest() // Get the most recent record
                    ->first();

                if ($attendance) {
                    // Update the attendance record with the check-out time
                    $attendance->check_out = Carbon::now();
                    $attendance->save();
                } else {
                    return response()->json(['error' => 'No active check-in found.'], 404);
                }
            }
        } catch (Exception $exp) {
            return response()->json(['error' => $exp->getMessage()], 500);
        }

        return response()->json([
            'userId' => $user_id,
            'message' => 'User  Check Out Successfully'
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('users::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('users::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
