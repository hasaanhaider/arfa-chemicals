<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class FactoryService
{
    /**
     * Handle user profile update.
     *
     * @param array $data
     * @return User
     * @throws ValidationException
     */
    public function getFactories()
    {
        return Factory::all();
    }
    public function createFactory(array $data)
    {
        $this->validation($data);
        return Factory::create($data);
    }

    public function editFactory($id)
    {
        return Factory::find($id);
    }
    public function updateFactory(array $data)
    {
        $this->validation($data);

        $job = Factory::findOrFail($data['id']);

        $job->update([
            'name' => $data['name'],
            'address' => $data['address'],
            'ntn_number' => $data['ntn_number'],
        ]);
    }

    public function delete($id)
    {
        Factory::destroy($id);
    }

    protected function validation(array $data)
    {

        Validator::make($data, [
            'name' => 'required',
            'address' => 'required',
            'ntn_number' => 'required',
        ])->validate();
    }
}
