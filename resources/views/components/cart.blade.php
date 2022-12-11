@props(['info'])

<div class="game mt-8">
    <div class="relative inline-block">
        <a href="{{ route('game.show', ['slug' => $info['slug']]) }}">
            @if (isset($info['cover']))
                <img src="{{ Str::replaceFirst('thumb', 'cover_big', $info['cover']['url'] ?? '') }}"
                    alt="{{ $info['name'] }}" loading="lazy"
                    class="hover:opacity-75 transition ease-in-out duration-150 rounded shadow">
            @endif
        </a>
        @if (isset($info['rating']))
            <div class="absolute bottom-0 right-0 w-16 h-16 bg-gray-800 rounded-full" style="right: -20px; bottom: -20px">
                <div id="{{ $info['slug'] }}"
                    class="font-semibold text-xs flex justify-center items-center h-full relative">
                </div>
                @push('scripts')
                    @include('_rating', [
                        'slug' => $info['slug'],
                        'rating' => round($info['rating']),
                        'event' => null,
                    ])
                @endpush
            </div>
        @endif
    </div>
    <a href="{{ route('game.show', ['slug' => $info['slug']]) }}"
        class="block text-base font-semibold leading-tight hover:text-gray-400 mt-8">
        {{ $info['name'] }}
    </a>
    <div class="text-gray-400 mt-1">
        @if (isset($platform['platforms']))
            {{ $platform['platforms'] }},
        @endif
    </div>
</div>
