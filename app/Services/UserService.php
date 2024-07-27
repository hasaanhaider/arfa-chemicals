<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserService
{
    /**
     * Handle user registration.
     *
     * @param array $data
     * @return User
     * @throws ValidationException
     */
    public function register(array $data)
    {
        $this->validate($data);
        $role = Role::where('name', $data['role'])->first();

        if (!$role) {
            throw ValidationException::withMessages(['role' => 'Invalid role']);
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role->id,
        ]);
    }

    /**
     * Validate user registration data.
     *
     * @param array $data
     * @throws ValidationException
     */
    protected function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|exists:roles,name',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }


    /**
     * Handle user registration.
     *
     * @param array $data
     * @return User
     * @throws ValidationException
     */
    public function login(array $data)
    {
        $this->loginvalidate($data);
        $credential = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        if (!Auth::attempt($credential)) {
            throw ValidationException::withMessages(['error' => 'Invalid credentials']);
        }

        $user = Auth::user();
        return ['user' => $user];
    }

    /**
     * Validate user registration data.
     *
     * @param array $data
     * @throws ValidationException
     */
    protected function loginvalidate(array $data)
    {
        $validator = Validator::make($data, [
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }



    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }


    public function changePassword(array $data)
    {
        Validator::validate($data, [
            'old_password' => 'required',
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);
        $user = User::find(Auth::user()->id);
        if (!Hash::check($data['old_password'], $user->password)) {
            throw ValidationException::withMessages(['old_password' => 'Invalid old password']);
        }
        $user->update(['password' => Hash::make($data['new_password'])]);
        return $user->fresh();
    }
}
