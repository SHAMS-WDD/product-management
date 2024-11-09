@extends('layouts.app')

@section('content')
    <div class="fixed inset-0 z-50 items-center justify-center overflow-auto bg-gray-800 bg-opacity-50 animated zoomIn"
        id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"> 
        <div class="flex items-center justify-center w-full min-h-screen"> 
            <div class="bg-white rounded-lg shadow-lg w-full max-w-md mx-auto"> 
                <div class="border-b px-4 py-2 flex justify-between items-center"> <
                    <h6 class="text-lg font-semibold" id="exampleModalLabel">Create Designation</h6>
                </div>
                <div class="p-4"> 
                    <form id="save-form" action="{{ route('products.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Product ID *</label>
                                <input type="text" name="product_id" value="{{ $product->product_id }}"
                                    class="w-full px-4 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200 ease-in-out placeholder-gray-400"
                                    focus:outline-none sm:text-sm" id="">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Product Name *</label>
                                <input type="text" name="name" value="{{ $product->name }}"
                                    class="w-full px-4 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200 ease-in-out placeholder-gray-400"
                                    id="">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Description *</label>
                                <input type="text" name="description" value="{{ $product->description }}"
                                    class="w-full px-4 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200 ease-in-out placeholder-gray-400"
                                    id="">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price *</label>
                                <input type="text" name="price" value="{{ $product->price }}"
                                    class="w-full px-4 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200 ease-in-out placeholder-gray-400"
                                    id="">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Stock *</label>
                                <input type="number" name="stock" value="{{ $product->stock }}"
                                    class="w-full px-4 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200 ease-in-out placeholder-gray-400"
                                    id="">
                            </div>
                            <div>
                                <br />
                                <img class="w-14 rounded-sm" id="newImg"
                                    src="{{ $product->image ? asset($product->image) : asset('images/default.jpg') }}" />
                                <br />

                                <label class="mb-2">Image</label>
                                <input oninput="newImg.src=window.URL.createObjectURL(this.files[0])" type="file"
                                    name="image"
                                    class="block w-full px-3 py-2 mb-3 text-base font-normal text-gray-900 bg-white border border-gray-300 rounded-md transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                    id="EmployeeImg">

                            </div>
                        </div>
                        <button type="submit" id="save-btn"
                            class="px-4 py-2 bg-green-600 text-white rounded-md shadow hover:bg-green-700 focus:outline-none">Update</button>
                        <div class="border-t px-4 py-2 flex justify-end space-x-2"> 
                            <a href="/products"
                                class="px-4 py-2 bg-red-600 text-white rounded-md shadow hover:bg-red-700 focus:outline-none"
                                aria-label="Close">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
