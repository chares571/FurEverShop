<?php

namespace App\Livewire\Admin;

use App\Models\Review;
use Livewire\Component;
use Livewire\WithPagination;

class ProductReviewManager extends Component
{
    use WithPagination;

    public string $search = '';
    public array $replyDrafts = [];

    public function mount(): void
    {
        $this->loadReplyDrafts();
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function saveReply(int $reviewId): void
    {
        $review = Review::query()->findOrFail($reviewId);
        $reply = trim((string) ($this->replyDrafts[$reviewId] ?? ''));

        if ($reply === '') {
            $review->update([
                'admin_reply' => null,
                'admin_replied_at' => null,
            ]);

            unset($this->replyDrafts[$reviewId]);

            $this->dispatch('notify', message: 'Reply removed successfully.');

            return;
        }

        validator(
            ['reply' => $reply],
            ['reply' => ['required', 'string', 'max:1500']]
        )->validate();

        $review->update([
            'admin_reply' => $reply,
            'admin_replied_at' => now(),
        ]);

        $this->replyDrafts[$reviewId] = $reply;

        $this->dispatch('notify', message: 'Reply saved successfully.');
    }

    protected function loadReplyDrafts(): void
    {
        $this->replyDrafts = Review::query()
            ->whereNotNull('admin_reply')
            ->pluck('admin_reply', 'id')
            ->map(fn ($reply) => (string) $reply)
            ->all();
    }

    public function render()
    {
        $reviews = Review::query()
            ->with(['user', 'product'])
            ->when($this->search !== '', function ($query) {
                $query->where(function ($subQuery) {
                    $subQuery
                        ->where('title', 'like', '%'.$this->search.'%')
                        ->orWhere('feedback', 'like', '%'.$this->search.'%')
                        ->orWhereHas('user', fn ($userQuery) => $userQuery->where('name', 'like', '%'.$this->search.'%'))
                        ->orWhereHas('product', fn ($productQuery) => $productQuery->where('name', 'like', '%'.$this->search.'%'));
                });
            })
            ->latest()
            ->paginate(8);

        return view('livewire.admin.product-review-manager', [
            'reviews' => $reviews,
            'averageRating' => round((float) Review::query()->avg('rating'), 1),
            'totalReviews' => Review::query()->count(),
        ])->layout('layouts.admin', [
            'title' => 'Product Reviews | FurEver',
        ]);
    }
}
