<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerProfile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile()
    {
        $profile = CustomerProfile::where('user_id', Auth::id())->first();

        if (!$profile) {
            return response()->json([
                'user' => Auth::user(),
                'profile' => null
            ]);
        }

        return response()->json([
            'user' => Auth::user(),
            'profile' => $profile
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|in:male,female,other',
            'residential_address' => 'nullable|string',
            'city' => 'nullable|string',
            'region' => 'nullable|string',
            'occupation' => 'nullable|string',
        ]);

        $profile = CustomerProfile::updateOrCreate(
            ['user_id' => Auth::id()],
            $request->only([
                'date_of_birth', 'gender', 'nationality', 'residential_address',
                'postal_address', 'city', 'ward', 'district', 'region',
                'occupation', 'employer_name', 'emergency_contact_name',
                'emergency_contact_phone'
            ])
        );

        return response()->json([
            'message' => 'Profile updated successfully',
            'profile' => $profile
        ]);
    }
}
