@props(['breadcrumbs' => []])

@if(count($breadcrumbs) > 0)
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-700 hover:text-orange-600">
                    <svg class="w-3 h-3 mr-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2A1 1 0 0 0 1 10h2v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-8h2a1 1 0 0 0 .707-1.707Z"/>
                    </svg>
                    Admin Dashboard
                </a>
            </li>
            @foreach($breadcrumbs as $breadcrumb)
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 text-slate-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        @if(isset($breadcrumb['url']))
                            <a href="{{ $breadcrumb['url'] }}" class="ml-1 text-sm font-medium text-slate-700 hover:text-orange-600 md:ml-2">{{ $breadcrumb['label'] }}</a>
                        @else
                            <span class="ml-1 text-sm font-medium text-slate-500 md:ml-2">{{ $breadcrumb['label'] }}</span>
                        @endif
                    </div>
                </li>
            @endforeach
        </ol>
    </nav>
@endif
