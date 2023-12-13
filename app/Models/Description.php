<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Description extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'role',

    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class,'app_id');
    }
}
