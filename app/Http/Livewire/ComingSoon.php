<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game;

class ComingSoon extends Component
{
    public $comingSoon = [];

    public function loadComingSoon()
    {
        $this->comingSoon = Cache::remember('load-coming-soon', 60 * 60 *  3, function () {
            return Game::select(['*'])
                ->with(['cover', 'platforms'])
                ->where('first_release_date', '>=', Carbon::now()->timestamp)
                ->limit(4)
                ->get();
        });
    }

    public function render()
    {
        return view('livewire.coming-soon');
    }
}
