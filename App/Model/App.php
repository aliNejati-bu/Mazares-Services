<?php

namespace MazaresServeces\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class App extends Model
{
    use HasFactory;

    protected $fillable = [
        'packagename',
        'app_name'
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }


    /**
     * @return HasMany
     */
    public function configs(): HasMany
    {
        return $this->hasMany(Config::class);
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