<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProfileService
{
    /**
     * Handle user profile update.
     *
     * @param array $data
     * @return User
     * @throws ValidationException
     */
    public function updateProfile(array $data)
    {
        $this->validate($data);
        $user = User::find(Auth::user()->id);

        // Handle file upload
        if (isset($data['company_cover_image'])) {
            if ($user->profile && $user->profile->company_cover_image) {
                Storage::delete($user->profile->company_cover_image);
            }
            $coverImage = $data['company_cover_image'];
            $coverImageName = time() . '.' . $coverImage->getClientOriginalExtension();
            $coverImagePath = $coverImage->storeAs('public/cover_images', $coverImageName);
            $data['company_cover_image'] = Storage::url($coverImagePath);
        }

        if (isset($data['company_logo_image'])) {
            if ($user->profile && $user->profile->company_logo_image) {
                Storage::delete($user->profile->company_logo_image);
            }
            $logoImage = $data['company_logo_image'];
            $logoImageName = time() . '.' . $logoImage->getClientOriginalExtension();
            $logoImagePath = $logoImage->storeAs('public/logo_images', $logoImageName);
            $data['company_logo_image'] = Storage::url($logoImagePath);
        }

        $user->profile ? $user->profile->update($data) : $user->profile()->create($data);
    }

    protected function validate(array $data)
    {
        Validator::make($data, [
            'company_name' => 'required', 'string', 'max:255',
            'company_email' => 'required', 'string', 'email', 'max:255', 'unique:user_profiles',
            'company_phone' => 'required', 'string', 'max:255',
            'company_address' => 'required', 'text',
            'company_city' => 'required', 'string', 'max:255',
            'company_country' => 'required', 'string', 'max:255',
            'company_industry' => 'required', 'string', 'max:255',
            'company_size' => 'required', 'int', 'max:255',
            'company_twitter' => 'required', 'string', 'max:255',
            'company_linkedin' => 'required', 'string', 'max:255',
            'company_instagram' => 'required', 'string', 'max:255',
            'company_facebook' => 'required', 'string', 'max:255',
            'company_founded_in' => 'required', 'string', 'max:255',
            'company_cover_image' => 'required', 'string', 'max:255',
            'company_logo_image' => 'required', 'string', 'max:255',  
            'company_description' => 'required', 'text',
            'company_website' => 'required', 'string', 'max:255',
        ])->validate();
    }


    public function getProfile()
    {
        return Auth::user()->profile;
    }
}
