<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Support\ProductCatalogBackup;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's product catalog from the local backup file.
     */
    public function run(): void
    {
        ProductCatalogBackup::load()->each(function (array $product): void {
            Product::query()->updateOrCreate(
                ['slug' => $product['slug']],
                [
                    'name' => $product['name'],
                    'category' => $product['category'],
                    'description' => $product['description'],
                    'price' => $product['price'],
                    'image' => $product['image'],
                    'stock' => $product['stock'],
                    'is_featured' => $product['is_featured'],
                ]
            );
        });
    }
}
