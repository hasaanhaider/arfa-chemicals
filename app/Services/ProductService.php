<?php

namespace App\Services;

use App\Models\Factory;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductService
{
    /**
     * Handle user profile update.
     *
     * @param array $data
     * @return User
     * @throws ValidationException
     */
    public function getProducts()
    {
        return Product::all();
    }
    public function createProduct(array $data)
    {
        $this->validation($data);
        return Product::create($data);
    }

    public function editProduct($id)
    {
        return Product::find($id);
    }
    public function updateProduct(array $data)
    {
        $this->validation($data);

        $job = Product::findOrFail($data['id']);

        $job->update([
            'name' => $data['name'],
        ]);
    }

    public function deleteProduct($id)
    {
        Product::destroy($id);
    }

    protected function validation(array $data)
    {

        Validator::make($data, [
            'name' => 'required',
        ])->validate();
    }
}
