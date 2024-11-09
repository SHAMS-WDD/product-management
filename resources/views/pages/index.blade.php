@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-4 px-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h1 class="font-bold text-2xl text-green-800">Product List</h1>
            </div>
            <div class="flex items-center gap-2">
                <a href="products/create"
                    class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 active:bg-green-800 transition duration-200 ease-in-out"
                    float-end">
                    Add Product
                </a>
            </div>
        </div>
    </div>
    <hr class="my-2" />

    <div class="container mx-auto">
        <div class="flex items-center gap-2">
            <div class="px-4">
                <form id="paginateForm" method="GET">
                    <label>Per Page</label>
                    <select name="per_page" id="perPage" onchange="document.getElementById('paginateForm').submit()"
                        class="form-select w-32 px-2 py-1 border border-gray-300 rounded text-sm">
                        <option value="5" {{ request('per_page') == 5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>

                    <input type="hidden" name="sort_by" value="{{ request('sort_by', 'name') }}">
                    <input type="hidden" name="sort_direction" value="{{ request('sort_direction', 'asc') }}">
                </form>
            </div>

            <div class="w-[50%]">
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="flex">
                        <input type="text" name="keyword" id="keyword"
                            class="w-full px-4 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors duration-200 ease-in-out placeholder-gray-400"
                            placeholder="Type product ID or description" value="{{ request('keyword') }}" />
                        <button type="submit"
                            class="py-1 bg-green-600 text-white text-sm px-3 rounded ml-1 hover:bg-green-700"
                            id="searchButton">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <hr class="my-2" />

    <div class="container mx-auto">
        <div class="row">

            <div class="w-full p-2">
                <div class="shadow-sm bg-white rounded p-2">
                    <table class="table-auto w-full" id="tableData">
                        <thead>
                            <tr class="bg-green-100 border border-green-300">
                                <th class="px-4 py-2 text-center">Image</th>
                                <th class="px-4 py-2 text-center">Product ID</th>
                                <th class="px-4 py-2 text-center"><a
                                        href="?sort_by=name&sort_direction={{ request('sort_direction') === 'asc' && request('sort_by') === 'name' ? 'desc' : 'asc' }}">
                                        @if (request('sort_by') === 'name' && request('sort_direction') === 'asc')
                                            &#9650; <!-- Up arrow for ascending -->
                                        @else
                                            &#9660; <!-- Down arrow for descending -->
                                        @endif
                                    </a> Product Name</th>
                                <th class="px-4 py-2 text-center"><a
                                        href="?sort_by=price&sort_direction={{ request('sort_direction') === 'asc' && request('sort_by') === 'price' ? 'desc' : 'asc' }}">
                                        @if (request('sort_by') === 'price' && request('sort_direction') === 'asc')
                                            &#9650; 
                                        @else
                                            &#9660; 
                                        @endif
                                    </a> Price</th>
                                <th class="px-4 py-2 text-center">Description</th>
                                <th class="px-4 py-2 text-center">Stock</th>
                                <th class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableList">
                            <!-- Dynamic table rows will go here -->
                            @foreach ($products as $product)
                                <tr class="border border-green-300">
                                    <td class="p-2 text-center align-middle"><img src="{{ asset($product->image) }}"
                                            style="height:36px;" alt="" class="inline-block"></td>
                                    <td class="p-2 text-center">{{ $product->product_id }}</td>
                                    <td class="p-2 text-center">{{ $product->name }}</td>
                                    <td class="p-2 text-center">${{ $product->price }}</td>
                                    <td class="p-2 text-center">{{ $product->description ?? '' }}</td>
                                    <td class="p-2 text-center">{{ $product->stock }}</td>
                                    <td class="p-2 text-center">
                                        <a href="{{ route('products.show', $product->id) }}"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-blue-600 border border-blue-600 rounded-md hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">View</a>
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="inline-flex items-center px-3 py-1 text-sm font-medium text-green-600 border border-green-600 rounded-md hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?' )"
                                                class="inline-flex items-center px-3 py-1 text-sm font-medium text-red-600 border border-red-600 rounded-md hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-4 px-6">
                {{ $products->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
