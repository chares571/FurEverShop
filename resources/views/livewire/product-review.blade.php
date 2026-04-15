<div class="fur-card space-y-8 p-6 sm:p-8">
    <!-- Review Stats -->
    <div class="border-b border-slate-100 pb-6">
        <div class="mb-4 flex items-start justify-between gap-4">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Customer Reviews</h2>
                <p class="mt-1 text-sm text-slate-600">{{ $totalReviews }} {{ $totalReviews === 1 ? 'review' : 'reviews' }}</p>
            </div>
            @if ($totalReviews > 0)
                <div class="text-right">
                    <p class="text-3xl font-black text-slate-900">{{ $averageRating }}</p>
                    <p class="text-lg text-orange-500">
                        @for ($i = 0; $i < 5; $i++)
                            {{ $i < round($averageRating) ? '★' : '☆' }}
                        @endfor
                    </p>
                </div>
            @endif
        </div>
    </div>

    <!-- Review Form -->
    <div class="space-y-4 border-b border-slate-100 pb-6">
        <h3 class="font-semibold text-slate-900">
            @auth
                {{ $userReview ? '✏️ Edit Your Review' : '✍️ Share Your Feedback' }}
            @else
                🔒 Log in to write a review
            @endauth
        </h3>

        @auth
            @if ($hasCompletedOrder)
                <form wire:submit="submit" class="space-y-4">
                    <!-- Rating Stars -->
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Rating</label>
                        <div class="flex gap-2 text-4xl">
                            @for ($i = 1; $i <= 5; $i++)
                                <button
                                    type="button"
                                    wire:click="$set('rating', {{ $i }})"
                                    class="transition {{ $i <= $rating ? 'text-orange-500' : 'text-slate-300 hover:text-orange-400' }}"
                                >
                                    ★
                                </button>
                            @endfor
                        </div>
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="text-sm font-semibold text-slate-700">Review Title (optional)</label>
                        <input
                            wire:model="title"
                            type="text"
                            id="title"
                            placeholder="e.g., Great quality, highly recommend!"
                            class="mt-1 w-full rounded-lg border border-slate-200 px-4 py-2 text-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-100"
                        >
                        @error('title')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Feedback -->
                    <div>
                        <label for="feedback" class="text-sm font-semibold text-slate-700">Your Feedback</label>
                        <textarea
                            wire:model="feedback"
                            id="feedback"
                            rows="4"
                            placeholder="Share your experience with this product..."
                            class="mt-1 w-full rounded-lg border border-slate-200 px-4 py-2 text-sm focus:border-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-100"
                        ></textarea>
                        @error('feedback')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-200"
                    >
                        {{ $userReview ? 'Update Review' : 'Submit Review' }}
                    </button>
                </form>
            @else
                <p class="rounded-lg bg-blue-50 px-4 py-3 text-sm text-blue-700">
                    ✓ You can review this product after you've received your order. Complete your purchase to start sharing feedback!
                </p>
            @endif
        @else
            <p class="rounded-lg bg-orange-50 px-4 py-3 text-sm text-orange-700">
                <a href="{{ route('login') }}" class="font-semibold hover:underline">Log in</a> or
                <a href="{{ route('register') }}" class="font-semibold hover:underline">create an account</a>
                to share your feedback.
            </p>
        @endauth
    </div>

    <!-- Reviews List -->
    <div class="space-y-4">
        @forelse ($reviews as $review)
            <div class="rounded-lg border border-slate-100 p-4 hover:bg-slate-50">
                <div class="mb-3 flex items-start justify-between gap-4">
                    <div>
                        <p class="font-semibold text-slate-900">{{ $review->user->name }}</p>
                        <p class="text-xs text-slate-500">{{ $review->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-lg text-orange-500">
                            @for ($i = 0; $i < 5; $i++)
                                {{ $i < $review->rating ? '★' : '☆' }}
                            @endfor
                        </p>
                        <p class="text-xs font-semibold text-slate-600">{{ $review->rating }}/5</p>
                    </div>
                </div>

                @if ($review->title)
                    <p class="mb-2 font-semibold text-slate-900">{{ $review->title }}</p>
                @endif

                <p class="text-sm leading-relaxed text-slate-700">{{ $review->feedback }}</p>
            </div>
        @empty
            <div class="rounded-lg border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                <p class="text-sm text-slate-500">No reviews yet. Be the first to share your feedback! 😊</p>
            </div>
        @endforelse
    </div>
</div>
