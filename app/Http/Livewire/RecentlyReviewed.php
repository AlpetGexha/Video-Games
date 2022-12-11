<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game;

class RecentlyReviewed extends Component
{
    public $recentlyReviewed = [];

    public function loadRecentlyReviewed()
    {
        $this->recentlyReviewed = Cache::remember('load-recently-reviewed', 60 * 60 * 6, function () {
            $before = Carbon::now()->subMonths(2)->timestamp;
            $curret = Carbon::now()->timestamp;

            return Game::select(['*'])
                ->with(['cover', 'platforms'])
                ->where('first_release_date', '>=', $before)
                ->where('first_release_date', '<', $curret)
                ->limit(3)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.recently-reviewed');
    }
}
