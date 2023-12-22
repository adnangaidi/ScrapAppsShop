<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'review_id',
        'store',
        'contry',
        'nb-start',
        'date',
        'used_period',
        'reply',
        'date_reply',
        'app_id'
    ];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class,'app_id');
    }
}
