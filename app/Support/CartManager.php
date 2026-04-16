<?php

namespace App\Support;

use App\Models\Product;
use Illuminate\Support\Collection;

class CartManager
{
    public const SESSION_KEY = 'furever_cart';
    public const BUY_NOW_SESSION_KEY = 'furever_buy_now';

    public static function content(): Collection
    {
        return collect(session(self::SESSION_KEY, []))
            ->map(fn (array $item, int $productId) => [
                'product_id' => (int) $productId,
                'name' => $item['name'],
                'price' => (float) $item['price'],
                'quantity' => (int) $item['quantity'],
                'image' => $item['image'] ?? null,
                'slug' => $item['slug'] ?? null,
                'stock' => (int) ($item['stock'] ?? 0),
                'subtotal' => (float) $item['price'] * (int) $item['quantity'],
            ])
            ->values();
    }

    public static function add(Product $product, int $quantity = 1): void
    {
        $cart = session(self::SESSION_KEY, []);
        $existing = $cart[$product->id]['quantity'] ?? 0;
        $newQuantity = min($product->stock, $existing + $quantity);

        $cart[$product->id] = [
            'name' => $product->name,
            'price' => (float) $product->price,
            'quantity' => $newQuantity,
            'image' => $product->image,
            'slug' => $product->slug,
            'stock' => $product->stock,
        ];

        session([self::SESSION_KEY => $cart]);
    }

    public static function startBuyNow(Product $product, int $quantity = 1): void
    {
        session([
            self::BUY_NOW_SESSION_KEY => [
                $product->id => [
                    'name' => $product->name,
                    'price' => (float) $product->price,
                    'quantity' => min($product->stock, $quantity),
                    'image' => $product->image,
                    'slug' => $product->slug,
                    'stock' => $product->stock,
                ],
            ],
        ]);
    }

    public static function update(Product $product, int $quantity): void
    {
        $cart = session(self::SESSION_KEY, []);

        if ($quantity <= 0) {
            unset($cart[$product->id]);
        } elseif (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = min($product->stock, $quantity);
            $cart[$product->id]['stock'] = $product->stock;
        }

        session([self::SESSION_KEY => $cart]);
    }

    public static function remove(int $productId): void
    {
        $cart = session(self::SESSION_KEY, []);
        unset($cart[$productId]);
        session([self::SESSION_KEY => $cart]);
    }

    public static function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public static function buyNowContent(): Collection
    {
        return collect(session(self::BUY_NOW_SESSION_KEY, []))
            ->map(fn (array $item, int $productId) => [
                'product_id' => (int) $productId,
                'name' => $item['name'],
                'price' => (float) $item['price'],
                'quantity' => (int) $item['quantity'],
                'image' => $item['image'] ?? null,
                'slug' => $item['slug'] ?? null,
                'stock' => (int) ($item['stock'] ?? 0),
                'subtotal' => (float) $item['price'] * (int) $item['quantity'],
            ])
            ->values();
    }

    public static function clearBuyNow(): void
    {
        session()->forget(self::BUY_NOW_SESSION_KEY);
    }

    public static function count(): int
    {
        return self::content()->sum('quantity');
    }

    public static function subtotal(): float
    {
        return self::content()->sum('subtotal');
    }
}
