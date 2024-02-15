<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Description extends Model
{
    use HasFactory;
    protected $fillable = [
        'desc_id',
        'title',
        'body',
        'role',
        'app_id'
    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class,'app_id');
    }
    public function roles(): HasMany{
      return $this->hasMany(Roles::class);
    }
}
