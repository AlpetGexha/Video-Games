<div wire:init="loadComingSoon" class="most-anticipated-container space-y-10 mt-8">
    @forelse ($comingSoon as $game)
        <div class="game flex">
            <a href="{{ route('game.show', ['slug' => $game['slug']]) }}">
                <img src="{{ Str::replaceFirst('thumb', 'cover_small', $game['cover']['url']) }}" loading="lazy"
                    alt="{{ $game->name }}" class="w-16 hover:opacity-75 transition ease-in-out duration-150">
            </a>
            <div class="ml-4">
                <a href="{{ route('game.show', ['slug' => $game['slug']]) }}" class="hover:text-gray-300">{{ $game->name }}</a>
                <div class="text-gray-400 text-sm mt-1">
                    {{ Carbon\Carbon::parse($game->first_release_date)->format('M d, Y') }}
                </div>
            </div>
        </div>
    @empty
        @foreach (range(1, 4) as $game)
            <x-skeleton-card-small />
        @endforeach
    @endforelse
</div>
