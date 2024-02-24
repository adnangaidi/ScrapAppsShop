<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryParent extends Model
{
    use HasFactory;
    protected $table='category_parents';
    protected $primaryKey = 'cp_id';
    public $timestamps = true;
    protected $fillable = [
        'cp_id',
        'name',
        'url',
    ];
    public function FerstsubCatigory(): HasMany
    {
        return $this->hasMany(FerstSubCatigory::class,'cp_id');
    }
    public function SecondsubCatigory(): HasMany
    {
        return $this->hasMany(SecondSubCatigory::class,'cp_id');
    }
    public static function getCategoryNameById($categoryId)
    {
        return static::where('cp_id', $categoryId)->value('name');
    }
}
