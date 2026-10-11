@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">Daftar Produk</h1>
    
    @auth
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
            <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
                Tambah Produk
            </a>
        @endif
    @endauth

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="border rounded-lg p-4 shadow">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded mb-2">
                <h3 class="font-bold text-lg">{{ $product->name }}</h3>
                <p class="text-gray-600">{{ $product->category->name }}</p>
                <p class="text-green-600 font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500">Stok: {{ $product->stock }}</p>
                <a href="{{ route('products.show', $product) }}" class="text-blue-500 hover:underline">Lihat Detail</a>
                
                @auth
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'editor')
                        <a href="{{ route('products.edit', $product) }}" class="text-yellow-500 hover:underline ml-2">Edit</a>
                    @endif
                    @if(auth()->user()->role === 'admin')
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline ml-2" onclick="return confirm('Yakin hapus?')">Hapus</button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
    </div>

    {{ $products->links() }}
</div>
@endsection