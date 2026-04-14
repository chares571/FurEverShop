<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Review;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ProductReview extends Component
{
    public Product $product;
    public int $rating = 5;
    public string $title = '';
    public string $feedback = '';
    public ?Review $userReview = null;
    public bool $hasCompletedOrder = false;

    public function mount()
    {
        if (Auth::check()) {
            // Check if user has a completed order containing this product
            $this->hasCompletedOrder = Order::where('user_id', Auth::id())
                ->where('status', Order::STATUS_COMPLETED)
                ->whereHas('items', function ($query) {
                    $query->where('product_id', $this->product->id);
                })
                ->exists();

            $this->userReview = Review::where('user_id', Auth::id())
                ->where('product_id', $this->product->id)
                ->first();

            if ($this->userReview) {
                $this->rating = $this->userReview->rating;
                $this->title = $this->userReview->title ?? '';
                $this->feedback = $this->userReview->feedback;
            }
        }
    }

    public function submit(): void
    {
        if (!Auth::check()) {
            $this->dispatch('notify', message: 'Please log in to submit a review.');
            return;
        }

        if (!$this->hasCompletedOrder) {
            $this->dispatch('notify', message: 'You can only review products you have purchased and received.', type: 'error');
            return;
        }

        $validated = $this->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['nullable', 'string', 'max:255'],
            'feedback' => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'product_id' => $this->product->id,
            ],
            [
                'rating' => $validated['rating'],
                'title' => $validated['title'],
                'feedback' => $validated['feedback'],
            ]
        );

        $this->userReview = Review::where('user_id', Auth::id())
            ->where('product_id', $this->product->id)
            ->first();

        $this->dispatch('notify', message: 'Review submitted successfully!');
    }

    public function render()
    {
        $reviews = Review::where('product_id', $this->product->id)
            ->with('user')
            ->latest()
            ->get();

        $averageRating = Review::where('product_id', $this->product->id)->avg('rating');
        $totalReviews = Review::where('product_id', $this->product->id)->count();

        return view('livewire.product-review', [
            'reviews' => $reviews,
            'averageRating' => round($averageRating, 1),
            'totalReviews' => $totalReviews,
            'hasCompletedOrder' => $this->hasCompletedOrder,
        ]);
    }
}
