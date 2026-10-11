@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Edit Produk</h1>
    
    <form action="{{ route('products.update', $product) }}" method="POST" class="max-w-2xl">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-2">Nama Produk</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required>{{ $product->description }}</textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Harga</label>
            <input type="number" name="price" value="{{ $product->price }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Stok</label>
            <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Update</button>
    </form>
</div>
@endsection