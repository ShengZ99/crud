<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Create User
    // public function create(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'phone' => 'required|unique:users,phone',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:6',
    //         'status' => 'required|in:active,inactive'
    //     ]);

    //     $user = User::create([
    //         'name' => $request->name,
    //         'phone' => $request->phone,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //         'status' => $request->status
    //     ]);

    //     return response()->json($user, 201);
    // }


    // public function index()
    // {
    //     $users = User::all();
    //     return response()->json($users);
    // }


    // public function show($id)
    // {
    //     $user = User::findOrFail($id);
    //     return response()->json($user);
    // }


    // public function destroy($id)
    // {
    //     $user = User::findOrFail($id);
    //     $user->delete();

    //     return response()->json(['message' => 'User deleted successfully']);
    // }

    public function index()
    {
        $users = User::all(); // Get all users
        return view('users.index', compact('users'));
        // $usersJson = json_encode($users); // Encode to JSON manually
        // return view('users.index', ['usersJson' => $usersJson]);
    }

    public function create()
    {
        return view('users.create'); // Return the view for creating a user
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'status' => 'required|in:active,inactive',
        ]);

        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => $request->status
        ]);

        return redirect()->route('users.index'); // Redirect after storing
    }

    // public function show($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('users.show', compact('user')); // Show user in a detailed view
    // }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));

        // $usersJson = json_encode($user);
        // return view('users.edit', ['usersJson' => $usersJson]);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|unique:users,phone,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'status' => 'required|in:active,inactive',
        ]);

        $user = User::findOrFail($id);
        
        // Update the user details except the password if it is empty
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
        return redirect()->route('users.index'); // Redirect after updating
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // Soft delete the user

        return redirect()->route('users.index')->with('message', 'User deleted successfully');
    }

    public function bulkDelete(Request $request)
    {
        $userIds = $request->input('users'); // Get the selected user IDs
        if ($userIds) {
            User::whereIn('id', $userIds)->delete(); // Delete the selected users
        }

        return redirect()->route('users.index')->with('success', 'Selected users deleted successfully.');
    }

    // Api
    public function apiIndex()
    {
        $users = User::all(); // Get all users
        return response()->json([
            'status' => 'success',
            'data' => $users
        ], 200); // 200 OK status
    }

    public function apiStore(Request $request)
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

    public function apiDestroy(string $id)
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
