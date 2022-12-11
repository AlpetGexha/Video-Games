<?php

namespace App\Models;

use MarcReichel\IGDBLaravel\Models\Model;
use Maize\Markable\Markable;
use Maize\Markable\Models\Like;

class Game extends Model
{
    use Markable;
    protected array $casts = [
        'bundles' => self::class,
        'dlcs' => self::class,
        'expansions' => self::class,
        'parent_game' => self::class,
        'remakes' => self::class,
        'remasters' => self::class,
        'similar_games' => self::class,
        'standalone_expansions' => self::class,
        'version_parent' => self::class,
    ];

    protected static $marks = [
        Like::class,
    ];
}
