<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }


    public function register(Request $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $data['role'] = 'employer';
        try{
            $user = $this->userService->register($data);
            return response()->json(['user' =>$user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function login(Request $request)
    {
        try{
            $user = $this->userService->login($request->only(['email', 'password']));
            return response()->json(['user' => $user, 'status' => 200], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 500], 500);
        }
    }


    public function logout(Request $request)
    {
        try{
            $this->userService->logout();
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function changePassword(Request $request)
    {
        try {
            $this->userService->changePassword($request->only(['old_password', 'new_password', 'new_password_confirmation']));
            return response()->json(['message' => 'Password changed successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
