<?php

namespace App\Http\Controllers;

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
        $data['role'] = 'user';
        try{
            $user = $this->userService->register($data);
            return response()->json(['user' =>$user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function indexView()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        try{
            $user = $this->userService->login($request->only(['email', 'password']));
            return to_route('index')->with('success', 'Successfully logged in');
            // return view('welcome', compact('user'))->with('success', 'Successfully logged in');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
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
}
