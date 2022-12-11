<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use MarcReichel\IGDBLaravel\Models\Game;

class PopullarGames extends Component
{

    public $popularGames = [];

    public function loadPopullarGames()
    {
        $before = Carbon::now()->subMonths(2)->timestamp;
        $after = Carbon::now()->addMonths(2)->timestamp;

        $games = Cache::remember('load-popullar-games', 60 * 60 * 6, function () use ($before, $after) {
            return Game::select(['*'])
                ->with(['cover', 'platforms'])
                ->where('first_release_date', '>=', $before)
                ->where('first_release_date', '<', $after)
                ->limit(12)
                ->get();
        });

        $this->popularGames = $this->formatForView($games);
        // dd($this->popularGames);
    }

    public function render()
    {
        return view('livewire.popullar-games');
    }

    public function formatForView($games)
    {
        return collect($games)->map(function ($game) {
            return collect($game)->merge([
                'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),
            ]);
        });
    }
}
