<?php

namespace App\Http\Controllers;

use App\Models\Game as ModelsGame;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use MarcReichel\IGDBLaravel\Models\Game;
use MarcReichel\IGDBLaravel\Models\AgeRating;

class GamesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function show($slug)
    {
        $gameUnFormat = Cache::remember('game-' . $slug, 60 * 60 * 6, function () use ($slug) {
            return ModelsGame::where('slug', $slug)
                ->with([
                    'cover', 'platforms', 'similar_games.cover', 'similar_games.platforms', 'similar_games', 'genres', 'involved_companies.company', 'screenshots', 'videos', 'websites'
                ])
                ->firstOrFail();
        });
        $game = $this->formatForView($gameUnFormat);
        // dump($game);
        return view('show', compact('game'));
    }

    private function formatForView($game)
    {
        return collect($game)->merge([
            'foo' => 'das',
            'involvedCompanies' => $game['involved_companies'][0]['company']['name'] ?? null,

            'trailer' => collect($game['videos'])->filter(function ($video) {
                return str_contains(Str::lower($video['name']), 'trailer');
            })->first()['video_id'] ?? null,

            'gameplay' => collect($game['videos'])->filter(function ($video) {
                return str_contains(Str::lower($video['name']), 'gameplay');
            })->first()['video_id'] ?? null,

            'genres' => collect($game['genres'])->pluck('name')->implode(', '),
            'platforms' => collect($game['platforms'])->pluck('abbreviation')->implode(', '),

            'memberRating' => $game['rating'] ? round($game['rating']) : '0',
            'criticRating' => $game['aggregated_rating'] ? round($game['aggregated_rating']) : '0',

            'social' => [
                'website' => collect($game['websites'])->first()['url'] ?? null,
                'facebook' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'facebook');
                })->first()['url'] ?? null,
                'twitter' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'twitter');
                })->first()['url'] ?? null,
                'instagram' => collect($game['websites'])->filter(function ($website) {
                    return Str::contains($website['url'], 'instagram');
                })->first()['url'] ?? null,
            ]
        ]);
    }

    public function games()
    {
        return view('games');
    }
    // private function formatForView($game)
    // {
    // }
}
