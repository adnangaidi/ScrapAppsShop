<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
class App extends Model
{
    use HasFactory;
    protected $fillable = [
        'app_id',
        'name',
        'logo',
        'images',
        'developer',
        'data_created',
        'langue',
        'categories',
    ];

    public function decription(): HasOne
    {
        return $this->hasOne(Description::class);
    }

    public function review(): HasMany
    {
        return $this->HasMany(Review::class);
    }

    public function tarif(): HasOne
    {
        return $this->hasOne(Tarif::class);
    }
    
}
