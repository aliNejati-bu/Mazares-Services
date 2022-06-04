<?php

namespace MazaresServices\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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


    /**
     * @return HasMany
     */
    public function getValues(): HasMany
    {
      return $this->hasMany(GetValue::class);
    }

}