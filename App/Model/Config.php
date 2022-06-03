<?php

namespace MazaresServeces\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Config extends Model
{
    use HasFactory;

    protected $fillable = [
        'config_name',
        'app_id'
    ];

    /**
     * @return BelongsTo
     */
    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(Value::class);
    }

    /**
     * @return HasMany
     */
    public function getValues(): HasMany
    {
        return $this->hasMany(GetValue::class);
    }
}