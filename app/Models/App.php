<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class App extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;
    protected $table = 'apps';
    protected $primaryKey = 'app_id';
    public $timestamps = true;
    protected $fillable = [
        'app_id',
        'name',
        'logo',
        'video',
        'developer',
        'date_created',
        'nb_review',
        'langue',
        'categories', 
        'subcategories',
        'subcategories1',
        'slug',
        'id'
    ];
    public function listapps():BelongsTo{
        return $this(list_apps::class);
    }
    public function decription(): HasMany
    {
        return $this->hasMany(Description::class);
    }

    public function review(): HasMany
    {
        return $this->HasMany(Review::class);
    }

    public function tarif(): HasMany
    {
        return $this->hasMany(Tarif::class);
    }
    
}
