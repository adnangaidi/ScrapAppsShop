<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $primaryKey = 'review_id';
    protected $fillable = [
        'review_id',
        'store',
        'contry',
        'nb_start',
        'date',
        'content',
        'used_period',
        'reply',
        'date_reply',
        'app_id'
    ];
    public static function getReview($appid)
    {
        $reviews = self::where('app_id', $appid)
                       ->where('nb_start', '<=', 3)
                       ->pluck('content')->toArray();
                       $texts=implode(', ', $reviews);

        return $texts;
    }
    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class, 'app_id');
    }
}
