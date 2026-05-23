<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }
    
    public function update(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Update user profile (demo - in real app, save to database)
            $user = auth()->user();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Profile updated successfully',
                'data' => [
                    'name' => $user->name,
                    'email' => $user->email,
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating profile',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function updatePassword(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Current password is required',
            'new_password.required' => 'New password is required',
            'new_password.min' => 'Password must be at least 8 characters',
            'new_password.confirmed' => 'Password confirmation does not match',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $user = auth()->user();
            
            // Verify current password
            if (!\Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect'
                ], 422);
            }
            
            // Update password
            $user->password = \Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating password',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function uploadAvatar(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'avatar' => 'required|file|max:5120',
        ], [
            'avatar.required' => 'Please select an image',
            'avatar.file' => 'File must be a valid file',
            'avatar.max' => 'File size must not exceed 5MB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/avatars'), $filename);
                
                // Update user avatar path
                $user = auth()->user();
                $user->avatar = $filename;
                $user->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Avatar uploaded successfully',
                    'data' => [
                        'avatar_url' => asset('uploads/avatars/' . $filename)
                    ]
                ], 200);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ], 422);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while uploading avatar',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function toggle2FA(Request $request)
    {
        try {
            $user = auth()->user();
            $user->two_factor_enabled = !$user->two_factor_enabled;
            $user->save();

            return response()->json([
                'success' => true,
                'message' => $user->two_factor_enabled ? '2FA enabled successfully' : '2FA disabled successfully',
                'data' => [
                    'two_factor_enabled' => $user->two_factor_enabled
                ]
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while updating 2FA status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
