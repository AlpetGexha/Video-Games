<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use MarcReichel\IGDBLaravel\Models\Game;

class MostAnticipated extends Component
{
    public $mostAnticipated = [];

    public function loadMostAnticipated()
    {
        $this->mostAnticipated =  Cache::remember('load-most-anticipated', 60 * 60 * 12, function () {
            $afterFourMonths = Carbon::now()->addMonths(4)->timestamp;

            return Game::select(['*'])
                ->with(['cover', 'platforms'])
                ->where('first_release_date', '>=', Carbon::now()->timestamp)
                ->where('first_release_date', '<', $afterFourMonths)
                ->limit(4)
                ->get();
        });
    }
    public function render()
    {
        return view('livewire.most-anticipated');
    }
}
