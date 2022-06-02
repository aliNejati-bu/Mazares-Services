<?php

namespace MazaresServeces\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Value extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'config_id',
        'name',
        'value'
    ];

    /**
     * @return BelongsTo
     */
    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }


    /**
     * @return BelongsTo
     */
    public function config(): BelongsTo
    {
        return $this->belongsTo(Config::class);
    }

}