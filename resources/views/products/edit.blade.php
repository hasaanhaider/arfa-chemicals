@extends('layout')

@section('content')
<div
    class="group-data-[sidebar-size=lg]:ltr:md:ml-vertical-menu group-data-[sidebar-size=lg]:rtl:md:mr-vertical-menu group-data-[sidebar-size=md]:ltr:ml-vertical-menu-md group-data-[sidebar-size=md]:rtl:mr-vertical-menu-md group-data-[sidebar-size=sm]:ltr:ml-vertical-menu-sm group-data-[sidebar-size=sm]:rtl:mr-vertical-menu-sm pt-[calc(theme('spacing.header')_*_1)] pb-[calc(theme('spacing.header')_*_0.8)] px-4 group-data-[navbar=bordered]:pt-[calc(theme('spacing.header')_*_1.3)] group-data-[navbar=hidden]:pt-0 group-data-[layout=horizontal]:mx-auto group-data-[layout=horizontal]:max-w-screen-2xl group-data-[layout=horizontal]:px-0 group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:ltr:md:ml-auto group-data-[layout=horizontal]:group-data-[sidebar-size=lg]:rtl:md:mr-auto group-data-[layout=horizontal]:md:pt-[calc(theme('spacing.header')_*_1.6)] group-data-[layout=horizontal]:px-3 group-data-[layout=horizontal]:group-data-[navbar=hidden]:pt-[calc(theme('spacing.header')_*_0.9)]">
    <div class="container-fluid group-data-[content=boxed]:max-w-boxed mx-auto">

        <div class="flex flex-col gap-2 py-4 md:flex-row md:items-center print:hidden">
            <div class="grow">
                <h5 class="text-16">Update Product</h5>
            </div>
            <ul class="flex items-center gap-2 text-sm font-normal shrink-0">
                <li
                    class="relative before:content-['\ea54'] before:font-remix ltr:before:-right-1 rtl:before:-left-1  before:absolute before:text-[18px] before:-top-[3px] ltr:pr-4 rtl:pl-4 before:text-slate-400 dark:text-zink-200">
                    <a href="#!" class="text-slate-400 dark:text-zink-200">Forms</a>
                </li>
                <li class="text-slate-700 dark:text-zink-100">
                    Update Product
                </li>
            </ul>
        </div>
        <div class="card">

            <form class="card-body" method="POST" action="{{ route('product.update', $product->id) }}">
                <input type="hidden" name="id" value="{{ $product->id }}">
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
                @method('PUT')
                @csrf
                <h6 class="mb-4 text-15">Update Product</h6>
                <div class="grid items-center grid-cols-1 gap-5 xl:grid-cols-3">
                    <div>
                        <label for="" class="">Name</label>
                        <input type="text" name="name" value="{{ $product->name }}"
                            class="px-5 py-3 text-15 form-input border-slate-200 dark:border-zink-500 focus:outline-none focus:border-custom-500 disabled:bg-slate-100 dark:disabled:bg-zink-600 disabled:border-slate-300 dark:disabled:border-zink-500 dark:disabled:text-zink-200 disabled:text-slate-500 dark:text-zink-100 dark:bg-zink-700 dark:focus:border-custom-800 placeholder:text-slate-400 dark:placeholder:text-zink-200"
                            placeholder="Enter Factory name">
                        @error('name')
                        <small>{{ $message }}</small>
                        @enderror
                    </div> 
                </div>
                <button type="submit"
                    class="text-white mt-3 btn bg-custom-500 border-custom-500 hover:text-white hover:bg-custom-600 hover:border-custom-600 focus:text-white focus:bg-custom-600 focus:border-custom-600 focus:ring focus:ring-custom-100 active:text-white active:bg-custom-600 active:border-custom-600 active:ring active:ring-custom-100 dark:ring-custom-400/20">Update</button>

        </div>

    </div>
    <!--end card-->



</div>
<!-- container-fluid -->
</div>
@endsection

@push('script')
<script src="{{ asset('assets/js/app.js') }}"></script>

@endpush