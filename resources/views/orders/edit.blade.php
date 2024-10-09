@extends('layout')

@section('content')
<div
    class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">
        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Update Order</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li
                    class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Forms</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Update Order
                </li>
            </ul>
        </div>
        <div class="card">
            <form class="card-body" method="POST" action="{{ route('order.update', $order->id) }}">
                @method('PUT')
                @if(session('success'))
                <div
                    class="flex gap-1 px-4 py-3 text-sm text-green-500 border border-green-200 rounded-md md:items-center bg-green-50 dark:bg-green-400/20 dark:border-green-500/50">
                    <i data-lucide="alert-circle" class="h-4"></i> {{ session('success') }}
                </div>
                @elseif (session('error'))
                <div
                    class="flex gap-1 px-4 py-3 text-sm text-red-500 border border-red-200 rounded-md md:items-center bg-red-50 dark:bg-red-400/20 dark:border-red-500/50">
                    <i data-lucide="alert-circle" class="h-4"></i> {{ session('error') }}
                </div>
                @endif
                @csrf
                <h6 class="mb-4 text-15">Update Order</h6>
                <div class="grid items-center grid-cols-1 gap-5 xl:grid-cols-3">
                    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id" id="user_id"
                        class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                        placeholder="Enter User ID" required>
                    <div class="relative">
                        <label for="product_id"
                            class="block text-sm font-medium text-slate-700 dark:text-zink-100">Product ID</label>
                        <select name="product_id" id="product_id"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500">
                            @foreach ($products as $product)
                            <option value="{{ $product->id }}" class="text-sm">{{ $product->name }}</option>
                            @endforeach
                        </select>
                        @error('product_id')
                        <small class="mt-1 text-xs text-red-500">{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="factory_id" class="">Factory ID</label>
                        <input value="{{ $factory->id }}" type="hidden" name="factory_id" id="factory_id"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Factory ID" required>
                        <input value="{{ $factory->name }}" readonly
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Factory ID" required>
                        @error('factory_id')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="">Quantity</label>
                        <input type="number" value="{{ $order->quantity }}" name="quantity" id="quantity"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Quantity" required>
                        @error('quantity')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="quantity" class="">Price Per Kg</label>
                        <input type="number" value="{{ $order->price_per_kg }}" name="price_per_kg" id="price_per_kg"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter price_per_kg" required>
                        @error('quantity')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="status" class="">Status</label>
                        <select name="status" id="status"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            required>
                            <option value="pending" @if ($order->status == 'pending') selected @endif>Pending</option>
                            <option value="approved" @if($order->status == 'approved') selected @endif>Approved</option>
                            <option value="rejected" @if($order->status == 'rejected') selected @endif>Rejected</option>
                            <option value="delivered" @if($order->status == 'delivered') selected @endif>Delivered</option>
                        </select>
                        @error('status')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="price_excluding_tax" class="">Price Excluding Tax</label>
                        <input type="number" value="{{ $order->price_excluding_tax }}" name="price_excluding_tax" id="price_excluding_tax"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Price Excluding Tax" required>
                        @error('price_excluding_tax')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="tax" class="">Tax</label>
                        <input type="number" value="18" readonly name="tax" id="tax"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Tax" required>
                        @error('tax')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="tax_value" class="">Tax Value</label>
                        <input type="number" value="{{ $order->tax_value }}"  readonly name="tax_value" id="tax_value"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Tax" required>
                        @error('tax_value')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="total_price" class="">Total Price</label>
                        <input type="number" value="{{ $order->total_price }}" name="total_price" id="total_price"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Total Price" required>
                        @error('total_price')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="total_price" class="">Order Date</label>
                        <input type="date" value="{{ $order->order_date }}" name="order_date" id="order_date"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500"
                            placeholder="Enter Total Price" required>
                        @error('order_date')
                        <small>{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <button type="submit"
                    class="text-white mt-3 btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Submit</button>
            </form>
        </div>
        <!--end card-->
    </div>
    <!-- container-fluid -->
</div>
@endsection

@push('script')
<script>
    const quantityInput = document.getElementById('quantity');
    const pricePerKgInput = document.getElementById('price_per_kg');
    const priceExcludingTaxInput = document.getElementById('price_excluding_tax');
    const taxInput = document.getElementById('tax');
    const taxValueInput = document.getElementById('tax_value');
    const totalPriceInput = document.getElementById('total_price');

    function calculatePrices() {
    const quantity = parseFloat(quantityInput.value) || 0;
    const pricePerKg = parseFloat(pricePerKgInput.value) || 0;
    const taxPercentage = parseFloat(taxInput.value) || 0;

    // Calculate price excluding tax
    const priceExcludingTax = quantity * pricePerKg;
    priceExcludingTaxInput.value = priceExcludingTax.toFixed(2);

    // Calculate tax value
    const taxValue = (priceExcludingTax * (taxPercentage / 100));
    taxValueInput.value = taxValue.toFixed(2);

    // Calculate total price including tax
    const totalPrice = priceExcludingTax + taxValue;
    totalPriceInput.value = totalPrice.toFixed(2);
}


    // Event listeners for input changes
    quantityInput.addEventListener('input', calculatePrices);
    pricePerKgInput.addEventListener('input', calculatePrices);
</script>
<script src="{{ asset('assets/js/app.js') }}"></script>
@endpush