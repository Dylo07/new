<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of all users (Admin only)
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Display the specified user (Admin only)
     */
    public function show(User $user)
    {
        // Load user with their bookings if the relationship exists
        if (method_exists($user, 'bookings')) {
            $user->load('bookings');
        }
        return view('admin.users.show', compact('user'));
    }

    /**
     * Update the specified user (Admin only)
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'is_admin' => ['sometimes', 'boolean'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->has('is_admin') ? $request->is_admin : $user->is_admin,
        ]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user (Admin only)
     */
    public function destroy(User $user)
    {
        // Prevent admin from deleting themselves
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'You cannot delete your own account.');
        }

        // Delete user bookings first if the relationship exists
        if (method_exists($user, 'bookings')) {
            $user->bookings()->delete();
        }
        
        // Delete the user
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }

    /**
     * Toggle admin status for a user
     */
    public function toggleAdmin(User $user)
    {
        // Prevent admin from removing their own admin status
        if ($user->id === auth()->id()) {
            return redirect()->back()
                ->with('error', 'You cannot change your own admin status.');
        }

        $user->update([
            'is_admin' => !$user->is_admin,
        ]);

        return redirect()->back()
            ->with('success', 'User admin status updated successfully.');
    }

    /**
     * Display the user's profile
     */
    public function profile()
    {
        $user = auth()->user();
        
        // Load user with their bookings if the relationship exists
        if (method_exists($user, 'bookings')) {
            $user->load('bookings');
        }
        
        return view('profile.index', compact('user'));
    }

    /**
     * Update the user's profile
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'phone' => ['nullable', 'string', 'max:20'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->back()
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Update the user's password
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $validator = Validator::make($request->all(), [
            'current_password' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator);
        }

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()
            ->with('success', 'Password updated successfully.');
    }
}