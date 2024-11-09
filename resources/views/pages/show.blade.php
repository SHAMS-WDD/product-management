@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 flex items-center justify-center z-50" id="emp-modal-home" role="dialog"
        aria-labelledby="modalLabel" aria-hidden="true" tabindex="-1">
        <!-- Modal Dialog -->
        <div class="w-full max-w-4xl bg-green-50 rounded-lg shadow-lg animate__animated animate__zoomIn">
            <!-- Modal Header -->
            <div class="border-b px-6 py-4 text-center">
                <h2 class="text-4xl font-semibold" id="modalLabel">Product Info</h2>
            </div>

            <!-- Modal Body -->
            <div class="w-full p-6">
                <!-- Product Card -->
                <div class="w-full mx-auto sm:w-full lg:w-10/12">
                    <div class="relative flex flex-col bg-white shadow-lg rounded-lg animate__fadeIn w-full">
                        <div class="flex-auto p-6">
                            <!-- Product Info -->
                            <div class="flex flex-col items-center pb-4 border-b">
                                <img id="empImage" class="rounded h-52" src="{{ asset($product->image) }}"
                                    alt="Product Image">
                                <h2 class="text-2xl font-bold" id="empName">{{ $product->name }}</h2>
                                <p><strong>Product ID:</strong> <span id="emp-court">{{ $product->product_id }}</span></p>
                                <p id="empDesignation" class="text-xl">Price:{{ ' ' . $product->price }}</p>
                                <p><strong>Stock:</strong> <span id="emp-section">{{ $product->stock }}</span></p>
                            </div>

                            <!-- Product Details -->
                            <div class="w-[60%] mx-auto">
                                <h1 class="text-center font-bold underline">Description</h1>
                                <div class="">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="border-t px-6 py-4 flex justify-end space-x-2">
                <a href="/products" id="emp-modal-home-close"
                    class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 focus:outline-none"
                    aria-label="Close" onclick="closeModal()">Close</a>
            </div>
        </div>
    </div>
@endsection
