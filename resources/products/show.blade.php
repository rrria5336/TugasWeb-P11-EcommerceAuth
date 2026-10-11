@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-96 object-cover rounded mb-4">
        <h1 class="text-4xl font-bold mb-2">{{ $product->name }}</h1>
        <p class="text-gray-600 mb-2">Kategori: {{ $product->category->name }}</p>
        <p class="text-green-600 text-2xl font-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-gray-700 mb-4">{{ $product->description }}</p>
        <p class="text-gray-500">Stok: {{ $product->stock }}</p>

        <h2 class="text-2xl font-bold mt-8 mb-4">Review</h2>
        @foreach($product->reviews as $review)
            <div class="border-b pb-4 mb-4">
                <p class="font-bold">{{ $review->user->name }}</p>
                <p class="text-yellow-500">{{ str_repeat('★', $review->rating) }}</p>
                <p class="text-gray-700">{{ $review->comment }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection