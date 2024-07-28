<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    public function __construct(ProductService $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        return view('products.index', ['products' => $this->product->getProducts()]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        try {
            $this->product->createProduct($request->all());
            return view('products.create')->with('success', 'Product added successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        return view('products.edit', ['product' => $this->product->editProduct($id)]);
    }

    public function update(Request $request, $id)
    {
        try {
            $this->product->updateProduct($request->all());
            return back()->with('success', 'Product updated successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->product->deleteProduct($id);
            return back()->with('success', 'Product deleted successfully');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
