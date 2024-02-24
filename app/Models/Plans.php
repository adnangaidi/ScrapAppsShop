<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plans extends Model
{
    use HasFactory;
    protected $table = 'plans';

    protected $fillable = [
        'id',
        'name',
        'price_id'
    ];

    public static function getPlans($appId)
    {
        return static::where('price_id', $appId)->pluck('name')->toArray();
    }
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Price::class);
    }
}
