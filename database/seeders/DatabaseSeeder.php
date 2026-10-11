<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat User Spesifik (Admin, Editor, User)
        User::factory()->create([
            'name' => 'Admin Utama',
            'email' => 'admin@ecommerce.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Editor Utama',
            'email' => 'editor@ecommerce.com',
            'role' => 'editor',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'User Biasa',
            'email' => 'user@ecommerce.com',
            'role' => 'user',
            'password' => bcrypt('password'),
        ]);

        // 2. Buat 10 User tambahan
        User::factory(10)->create();

        // 3. Buat 5 Kategori
        $categories = Category::factory(5)->create();

        // 4. Buat 55 Produk (lebih dari 50 sesuai tugas)
        Product::factory(55)->create()->each(function ($product) {
            // Buat 2 sampai 5 review untuk setiap produk
            Review::factory(rand(2, 5))->create([
                'product_id' => $product->id,
            ]);
        });
    }
}