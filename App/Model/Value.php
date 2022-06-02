<?php

namespace MazaresServeces\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'game_id',
        'config_id',
        'name',
        'value'
    ];

    /**
     * @return BelongsTo
     */
    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }


    /**
     * @return BelongsTo
     */
    public function config(): BelongsTo
    {
        return $this->belongsTo(Config::class);
    }

}