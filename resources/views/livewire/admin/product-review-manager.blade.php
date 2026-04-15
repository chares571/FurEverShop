<div class="space-y-8">
    <section class="fur-toolbar">
        <div>
            <p class="fur-section-kicker">Product reviews</p>
            <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">Read ratings, customer feedback, and publish store replies.</h1>
            <p class="mt-3 max-w-2xl text-sm leading-7 text-slate-500">Use this space to monitor sentiment across products and respond publicly as <span class="font-semibold text-slate-700">furevershop</span>.</p>
        </div>

        <div class="flex flex-wrap items-center gap-3 text-sm text-slate-600">
            <span>Total reviews: <span class="font-bold text-slate-900">{{ $totalReviews }}</span></span>
            <span>Average rating: <span class="font-bold text-slate-900">{{ $averageRating > 0 ? $averageRating.'/5' : 'No ratings yet' }}</span></span>
            <input wire:model.live.debounce.350ms="search" type="text" placeholder="Search product, customer, or feedback..." class="fur-input min-w-[260px]">
        </div>
    </section>

    <section class="space-y-4">
        @forelse ($reviews as $review)
            <article class="fur-card overflow-hidden">
                <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50/95 to-white px-6 py-6">
                    <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                        <div class="flex min-w-0 flex-1 items-start gap-4">
                            <div class="flex h-20 w-20 shrink-0 items-center justify-center overflow-hidden rounded-[22px] bg-gradient-to-br from-orange-100 via-white to-blue-100">
                                @if ($review->product?->image)
                                    @if (strpos($review->product->image, 'http') === 0)
                                        <img src="{{ $review->product->image }}" alt="{{ $review->product->name }}" class="h-full w-full object-cover" loading="lazy">
                                    @else
                                        <img src="{{ asset('storage/'.$review->product->image) }}" alt="{{ $review->product->name }}" class="h-full w-full object-cover" loading="lazy">
                                    @endif
                                @elseif ($review->product)
                                    <span class="text-2xl font-black text-white/90 drop-shadow">{{ strtoupper(substr($review->product->name, 0, 1)) }}</span>
                                @else
                                    <span class="text-xs font-black uppercase tracking-[0.2em] text-slate-400">N/A</span>
                                @endif
                            </div>

                            <div class="min-w-0 flex-1">
                                <p class="text-xs font-bold uppercase tracking-[0.3em] text-slate-400">Product review</p>
                                <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900 sm:text-4xl">{{ $review->product?->name ?? 'Product removed' }}</h2>
                                <p class="mt-3 text-lg font-bold text-slate-800">{{ $review->title ?: 'Customer feedback' }}</p>
                                <p class="mt-2 text-sm text-slate-600">By {{ $review->user->name }} | {{ $review->created_at->format('M d, Y g:i A') }}</p>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2 lg:items-end">
                            <p class="text-3xl font-black text-slate-900">{{ $review->rating }}/5</p>
                            <p class="text-sm font-semibold text-orange-500">
                                @for ($i = 0; $i < 5; $i++)
                                    {{ $i < $review->rating ? '★' : '☆' }}
                                @endfor
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-5 px-6 py-6">
                    <div class="rounded-[22px] border border-slate-100 bg-slate-50/90 p-5">
                        <p class="text-sm font-semibold text-slate-700">Customer feedback</p>
                        <p class="mt-3 text-sm leading-7 text-slate-700">{{ $review->feedback }}</p>
                    </div>

                    @if ($review->has_admin_reply)
                        <div class="rounded-[22px] border border-orange-100 bg-orange-50/70 p-5">
                            <div class="flex flex-wrap items-center justify-between gap-3">
                                <p class="text-sm font-semibold text-slate-900">{{ \App\Models\Review::ADMIN_DISPLAY_NAME }}</p>
                                <p class="text-xs font-medium text-slate-500">Visible reply | {{ $review->admin_replied_at?->format('M d, Y g:i A') }}</p>
                            </div>
                            <p class="mt-3 text-sm leading-7 text-slate-700">{{ $review->admin_reply }}</p>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <label for="reply-{{ $review->id }}" class="text-sm font-semibold text-slate-700">Store reply</label>
                        <textarea
                            id="reply-{{ $review->id }}"
                            wire:model.defer="replyDrafts.{{ $review->id }}"
                            rows="4"
                            placeholder="Write a public reply as furevershop..."
                            class="fur-input text-sm"
                        ></textarea>
                        <div class="flex flex-wrap items-center gap-3">
                            <button wire:click="saveReply({{ $review->id }})" class="fur-button">
                                Save reply
                            </button>
                            @if ($review->has_admin_reply)
                                <button wire:click="$set('replyDrafts.{{ $review->id }}', '')" class="fur-button-secondary">
                                    Clear draft
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </article>
        @empty
            <div class="fur-card p-12 text-center">
                <h3 class="text-xl font-black text-slate-900">No product reviews yet</h3>
                <p class="mt-2 text-sm text-slate-500">Customer ratings and feedback will appear here once reviews start coming in.</p>
            </div>
        @endforelse
    </section>

    <div>{{ $reviews->links() }}</div>
</div>
