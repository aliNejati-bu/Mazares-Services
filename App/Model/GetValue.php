<?php

namespace MazaresServeces\App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GetValue extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_id',
        'config_id',
        'value_id',
        'getter_ip',
        'user_id',
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
     * @return BelongsTo
     */
    public function value(): BelongsTo
    {
        return $this->belongsTo(Value::class);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}