<div class="fur-card overflow-hidden p-6 sm:p-8">
    <div class="grid gap-8 xl:grid-cols-[minmax(0,0.88fr)_minmax(360px,1.12fr)]">
        <div class="space-y-6">
            <div class="fur-subtle-panel p-5 sm:p-6">
                <p class="fur-section-kicker">Customer Reviews</p>
                <div class="mt-4 flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-2xl font-black text-slate-900">What shoppers are saying</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-500">{{ $totalReviews }} {{ $totalReviews === 1 ? 'review' : 'reviews' }} from verified buyers.</p>
                    </div>
                    @if ($totalReviews > 0)
                        <div class="rounded-[24px] bg-white px-4 py-4 text-right shadow-sm">
                            <p class="text-3xl font-black text-slate-900">{{ $averageRating }}</p>
                            <div class="mt-1 text-lg leading-none text-orange-500">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < round($averageRating))
                                        &#9733;
                                    @else
                                        &#9734;
                                    @endif
                                @endfor
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="fur-subtle-panel p-5 sm:p-6">
                <h3 class="text-lg font-black text-slate-900">
                    @auth
                        {{ $userReview ? 'Edit your review' : 'Share your feedback' }}
                    @else
                        Log in to write a review
                    @endauth
                </h3>
                <p class="mt-2 text-sm leading-6 text-slate-500">
                    @auth
                        Tell other shoppers what stood out to you about this product.
                    @else
                        Sign in or create an account to leave a rating and product feedback.
                    @endauth
                </p>

                @auth
                    @if ($hasCompletedOrder)
                        <form wire:submit="submit" class="mt-5 space-y-4">
                            <div class="space-y-2">
                                <label class="text-sm font-semibold text-slate-700">Rating</label>
                                <div class="flex flex-wrap gap-2 text-4xl">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <button
                                            type="button"
                                            wire:click="$set('rating', {{ $i }})"
                                            class="leading-none transition {{ $i <= $rating ? 'text-orange-500' : 'text-slate-300 hover:text-orange-400' }}"
                                        >
                                            &#9733;
                                        </button>
                                    @endfor
                                </div>
                            </div>

                            <div>
                                <label for="title" class="text-sm font-semibold text-slate-700">Review title</label>
                                <input
                                    wire:model="title"
                                    type="text"
                                    id="title"
                                    placeholder="Example: Great quality and easy to use"
                                    class="fur-input mt-2"
                                >
                                @error('title')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="feedback" class="text-sm font-semibold text-slate-700">Your feedback</label>
                                <textarea
                                    wire:model="feedback"
                                    id="feedback"
                                    rows="5"
                                    placeholder="Share what you liked, how it arrived, and whether you would recommend it."
                                    class="fur-input mt-2 text-sm"
                                ></textarea>
                                @error('feedback')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="fur-button w-full">
                                {{ $userReview ? 'Update review' : 'Submit review' }}
                            </button>
                        </form>
                    @else
                        <div class="mt-5 rounded-[22px] border border-blue-100 bg-blue-50 px-4 py-4 text-sm leading-6 text-blue-800">
                            You can review this product after your completed order is marked as received.
                        </div>
                    @endif
                @else
                    <div class="mt-5 rounded-[22px] border border-orange-100 bg-orange-50 px-4 py-4 text-sm leading-6 text-orange-800">
                        <a href="{{ route('login') }}" class="font-semibold hover:underline">Log in</a> or
                        <a href="{{ route('register') }}" class="font-semibold hover:underline">create an account</a>
                        to leave a rating and review.
                    </div>
                @endauth
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <div class="fur-metric-card">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-slate-400">Average Rating</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $totalReviews > 0 ? $averageRating : '0.0' }}</p>
                </div>
                <div class="fur-metric-card">
                    <p class="text-xs font-bold uppercase tracking-[0.24em] text-slate-400">Verified Reviews</p>
                    <p class="mt-2 text-3xl font-black text-slate-900">{{ $totalReviews }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <div>
                <p class="fur-section-kicker">Latest Feedback</p>
                <h3 class="mt-2 text-2xl font-black text-slate-900">Recent customer reviews</h3>
            </div>

            @forelse ($reviews as $review)
                <article class="fur-subtle-panel p-5 sm:p-6">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                        <div class="min-w-0">
                            <div class="flex flex-wrap items-center gap-3">
                                <p class="font-black text-slate-900">{{ $review->user->name }}</p>
                                <span class="text-xs font-medium text-slate-400">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            @if ($review->title)
                                <p class="mt-3 text-lg font-bold text-slate-900">{{ $review->title }}</p>
                            @endif
                        </div>

                        <div class="rounded-[20px] bg-white px-4 py-3 text-right shadow-sm">
                            <div class="text-lg leading-none text-orange-500">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $review->rating)
                                        &#9733;
                                    @else
                                        &#9734;
                                    @endif
                                @endfor
                            </div>
                            <p class="mt-1 text-xs font-semibold text-slate-600">{{ $review->rating }}/5</p>
                        </div>
                    </div>

                    <p class="mt-4 text-sm leading-7 text-slate-700">{{ $review->feedback }}</p>

                    @if ($review->has_admin_reply)
                        <div class="mt-5 rounded-[22px] border border-orange-100 bg-orange-50/80 p-4">
                            <div class="flex items-center justify-between gap-4">
                                <p class="font-semibold text-slate-900">{{ \App\Models\Review::ADMIN_DISPLAY_NAME }}</p>
                                <p class="text-xs text-slate-500">{{ $review->admin_replied_at?->diffForHumans() }}</p>
                            </div>
                            <p class="mt-2 text-sm leading-7 text-slate-700">{{ $review->admin_reply }}</p>
                        </div>
                    @endif
                </article>
            @empty
                <div class="rounded-[24px] border border-dashed border-slate-200 bg-slate-50 p-8 text-center">
                    <p class="text-lg font-bold text-slate-900">No reviews yet</p>
                    <p class="mt-2 text-sm text-slate-500">Be the first verified customer to share feedback on this product.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
