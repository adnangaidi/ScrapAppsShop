<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tarif extends Model
{
    use HasFactory;
    protected $fillable = [
        'tarif_id',
        'name',
        'price', 
        'plan',
        'app_id'
    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function plans():HasMany{
        return $this->hasMany(Plans::class);
    }
}
