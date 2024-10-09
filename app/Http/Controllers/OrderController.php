<?php

namespace App\Http\Controllers;

use App\Models\Factory;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display a listing of the orders
    public function index($id)
    {
        $orders = Order::where('factory_id', $id)->get();
        $factory_id = $id;
        return view('orders.index', compact('orders', 'factory_id'));
    }

    // Show the form for creating a new order
    public function create($id)
    {
        $products = Product::all();
        $factory = Factory::where('id', $id)->first();
        return view('orders.create', compact('factory', 'products'));
    }

    // Store a newly created order in storage
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'factory_id' => 'required|exists:factories,id',
            'quantity' => 'required|integer',
            'status' => 'required|in:pending,approved,rejected,delivered',
            'price_excluding_tax' => 'required|numeric',
            'tax' => 'required|numeric',
            'total_price' => 'required|numeric',
            'price_per_kg' => 'required|numeric',
            'tax_value' => 'required|numeric',
            'order_date' => 'required|date_format:Y-m-d',
        ]);

        Order::create($request->all());
        return redirect()->back()->with('success', 'Order created successfully.');
    }

    // Display the specified order
    public function show($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.show', compact('order'));
    }

    // Show the form for editing the specified order
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', compact('order'));
    }

    // Update the specified order in storage
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $request->validate([
            'user_id' => 'sometimes|required|exists:users,id',
            'product_id' => 'sometimes|required|exists:products,id',
            'factory_id' => 'sometimes|required|exists:factories,id',
            'quantity' => 'sometimes|required|integer',
            'status' => 'sometimes|required|in:pending,approved,rejected,delivered',
            'price_excluding_tax' => 'sometimes|required|integer',
            'tax' => 'sometimes|required|integer',
            'total_price' => 'sometimes|required|integer',
            'price_per_kg' => 'sometimes|required|integer',
            'tax_value' => 'sometimes|required|integer',
            'order_date' => 'sometimes|required|date_format:Y-m-d',
        ]);

        $order->update($request->all());
        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    // Remove the specified order from storage
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
    }
}
