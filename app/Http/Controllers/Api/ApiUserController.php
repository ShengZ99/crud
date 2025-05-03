<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all(); // Get all users
        return response()->json([
            'status' => 'success',
            'data' => $users
        ], 200); // 200 OK status
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'status' => 'required|in:active,inactive',
        ]);

        // Create new user in the database
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);

        // Return a JSON response with the newly created user data
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'data' => $user
        ], 201); // HTTP 201 for resource creation
    }

    public function show(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        
        if ($user) {
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->status = $request->status;

            // Check if the user has filled the password field
            if ($request->filled('password')) {
                // Compare the submitted password with the current password
                if (Hash::check($request->password, $user->password)) {
                    // If the password is the same, return with a message
                    return redirect()->back()->with('message', 'The new password is the same as the current one.');
                } else {
                    // If different, hash the new password and update it
                    $user->password = Hash::make($request->password);
                }
            }

            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'User updated successfully',
                'data' => $user
            ], 200); // 200 OK status
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404); // 404 Not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'User deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found'
            ], 404); // 404 Not Found
        }
    }
}
