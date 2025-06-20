@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Edit Product</h3>
            <form method="POST" action="{{ route('products.update', $product->id) }}" class="mt-5 space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name" id="name"
                        class="mt-1 block w-full border @error('name') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-md shadow-sm py-2 px-3 focus:outline-none sm:text-sm"
                        value="{{ old('name', $product->name) }}"
                        required>
                    @error('name')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" step="0.01" name="price" id="price"
                        class="mt-1 block w-full border @error('price') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-md shadow-sm py-2 px-3 focus:outline-none sm:text-sm"
                        value="{{ old('price', $product->price) }}"
                        required>
                    @error('price')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="mt-1 block w-full border @error('stock') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-md shadow-sm py-2 px-3 focus:outline-none sm:text-sm"
                        value="{{ old('stock', $product->stock) }}"
                        required>
                    @error('stock')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full border @error('description') border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 text-gray-900 placeholder-gray-500 focus:ring-blue-500 focus:border-blue-500 @enderror rounded-md shadow-sm py-2 px-3 focus:outline-none sm:text-sm">{{ old('description', $product->description) }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection