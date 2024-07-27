<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $user_profile ;

    public function __construct(ProfileService $user_profile)
    {
        $this->user_profile = $user_profile;
    }

    public function index()
    {
        try {
            return response()->json(['data' => $this->user_profile->getProfile()], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function updateProfile(Request $request)
    {
        try {
            $this->user_profile->updateProfile($request->all());
            return response()->json(['message' => 'Successfully updated'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
