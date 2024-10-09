@extends('layout')

@section('content')
<div
    class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">
                    Orders
                </h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li
                    class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1 before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">List</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Orders
                </li>

            </ul>
        </div>
        <div class="card">
            <div class="card-body">
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
                <div class="flex gap-2 justify-between mb-4 items-center">
                    <h6 class="mb-4 text-15">Orders</h6>
                <a href="{{ route('order.create', $factory_id ) }}" class="text-slate-400 dark:text-zink-200 p-2 bg-slate-100 dark:bg-zink-700 rounded">Create Order</a>
                </div>

                <table id="basic_tables" class="display stripe group" style="width:100%">
                    <thead>
                        <tr>
                            <th class="ltr:!text-left rtl:!text-right">Order ID</th>
                            <th>Product Name</th>
                            <th>Price Per Kg</th>
                            <th>Quantity(KG)</th>
                            <th>Price Excluding Tax</th>
                            <th>Tax Value</th>
                            <th>Price Including tax</th>
                            <th>Order Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->product_name }}</td>
                            <td>RS{{ number_format($order->price_per_kg, 2) }}</td>
                            <td>{{ $order->quantity }}KG</td>
                            <td>RS{{ number_format($order->price_excluding_tax, 2) }}</td>
                            <td>RS{{ number_format($order->tax_value, 2) }}</td>
                            <td>RS{{ number_format($order->total_price, 2) }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->status }}</td>
                            <td class="flex justify-end items-center gap-2">
                                <a href="{{ route('order.edit', $order->id) }}"
                                    class="text-yellow-500 d-block bg-yellow-100 btn hover:text-white hover:bg-yellow-600 focus:text-white focus:bg-yellow-600 focus:ring focus:ring-yellow-100 active:text-white active:bg-yellow-600 active:ring active:ring-yellow-100 dark:bg-yellow-500/20 dark:text-yellow-500 dark:hover:bg-yellow-500 dark:hover:text-white dark:focus:bg-yellow-500 dark:focus:text-white dark:active:bg-yellow-500 dark:active:text-white dark:ring-yellow-400/20">
                                    Edit
                                </a>
                                <form class="d-block" action="{{ route('order.destroy', $order->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this order?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-500 bg-red-100 btn hover:text-white hover:bg-red-600 focus:text-white focus:bg-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:ring active:ring-red-100 dark:bg-red-500/20 dark:text-red-500 dark:hover:bg-red-500 dark:hover:text-white dark:focus:bg-red-500 dark:focus:text-white dark:active:bg-red-500 dark:active:text-white dark:ring-red-400/20">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--end card-->

    </div>
    <!-- container-fluid -->
</div>
@endsection

@push('script')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this order?');
    }
</script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script src="{{ asset('assets/js/datatables/datatables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/jquery-3.7.0.js') }}"></script>
<script src="{{ asset('assets/js/datatables/data-tables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/data-tables.tailwindcss.min.js') }}"></script>
<script src="{{ asset('assets/js/datatables/datatables.init.js') }}"></script>
@endpush
