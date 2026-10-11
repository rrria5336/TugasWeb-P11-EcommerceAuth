@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Tambah Produk Baru</h1>
    
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
        @csrf
        <div class="mb-4">
            <label class="block mb-2">Nama Produk</label>
            <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2" required></textarea>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Harga</label>
            <input type="number" name="price" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Stok</label>
            <input type="number" name="stock" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Kategori</label>
            <select name="category_id" class="w-full border rounded px-3 py-2" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4">
            <label class="block mb-2">Gambar</label>
            <input type="file" name="image" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection