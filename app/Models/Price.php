<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Price extends Model
{
    use HasFactory;
    protected $table='prices';
    protected $primaryKey='price_id'; 
    protected $fillable = [
        'price_id',
        'name',
        'price', 
        'app_id'
    ];

    protected static function getPrices($appId)
    {
        return  static::where('app_id', $appId)->get();
    }






    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function plans():HasMany{
        return $this->hasMany(Plans::class);
    }
}
