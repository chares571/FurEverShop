<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    protected static array $catalog = [
        [
            'name' => 'CloudSoft Orthopedic Dog Bed',
            'category' => 'dogs',
            'description' => 'A supportive memory-foam dog bed with a washable cover and raised edges for pets who love to curl up after walks.',
            'price' => 49.95,
            'stock' => 12,
        ],
        [
            'name' => 'TrailReady No-Pull Dog Harness',
            'category' => 'dogs',
            'description' => 'An adjustable everyday harness with padded straps, reflective trim, and a front clip for more controlled walks.',
            'price' => 28.50,
            'stock' => 18,
        ],
        [
            'name' => 'Pawsafe LED Night Collar',
            'category' => 'dogs',
            'description' => 'A rechargeable glowing collar designed for evening walks, helping your dog stay visible in low light.',
            'price' => 19.99,
            'stock' => 20,
        ],
        [
            'name' => 'FetchLoop Rope Tug Toy',
            'category' => 'dogs',
            'description' => 'A durable cotton rope toy built for tug games, fetch practice, and healthy chewing sessions.',
            'price' => 11.75,
            'stock' => 25,
        ],
        [
            'name' => 'WhiskerHide Cat Tunnel',
            'category' => 'cats',
            'description' => 'A crinkly collapsible tunnel that gives indoor cats a playful hideaway for pouncing, stalking, and napping.',
            'price' => 24.40,
            'stock' => 14,
        ],
        [
            'name' => 'MoonPaw Sisal Scratching Post',
            'category' => 'cats',
            'description' => 'A compact scratching post wrapped in natural sisal to keep claws busy and furniture safer.',
            'price' => 32.00,
            'stock' => 10,
        ],
        [
            'name' => 'QuietSip Stainless Pet Fountain',
            'category' => 'cats',
            'description' => 'A low-noise water fountain with multi-stage filtration that encourages cats and small pets to drink more often.',
            'price' => 39.90,
            'stock' => 9,
        ],
        [
            'name' => 'FeatherDash Interactive Wand',
            'category' => 'cats',
            'description' => 'A lightweight wand toy with replaceable feather attachments for lively indoor play and bonding time.',
            'price' => 13.25,
            'stock' => 22,
        ],
        [
            'name' => 'CarryNest Travel Pet Carrier',
            'category' => 'dogs',
            'description' => 'A breathable soft-sided carrier with mesh windows, a padded base, and secure zippers for trips to the vet or weekend travel.',
            'price' => 54.00,
            'stock' => 8,
        ],
        [
            'name' => 'TidyPaws Silicone Feeding Mat',
            'category' => 'hamsters',
            'description' => 'A non-slip feeding mat that catches splashes and crumbs, making mealtime cleanup much easier.',
            'price' => 14.60,
            'stock' => 30,
        ],
        [
            'name' => 'SnuggleWrap Pet Blanket',
            'category' => 'rabbits',
            'description' => 'A plush fleece blanket for sofas, crates, and car rides that helps keep pets warm and your furniture cleaner.',
            'price' => 17.80,
            'stock' => 16,
        ],
        [
            'name' => 'FreshPaw Grooming Kit',
            'category' => 'cats',
            'description' => 'A beginner-friendly grooming set with a slicker brush, nail clipper, comb, and storage pouch.',
            'price' => 26.35,
            'stock' => 11,
        ],
    ];

    public function definition(): array
    {
        $product = Arr::random(self::$catalog);

        return [
            'name' => $product['name'],
            'slug' => Str::slug($product['name']).'-'.fake()->unique()->numberBetween(100, 999),
            'category' => $product['category'],
            'description' => $product['description'],
            'price' => $product['price'],
            'image' => null,
            'stock' => $product['stock'],
            'is_featured' => false,
        ];
    }
}
