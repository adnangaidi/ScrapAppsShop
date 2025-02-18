<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class FerstSubCatigory extends Model
{
    use HasFactory;
    protected $table='ferst_sub_catigories';
    protected $primaryKey = 'fsc_id';
    public $timestamps = true;
    protected $fillable = [
        'fsc_id',
        'name',
        'url',
        'cp_id'
    ];
    public function Categories(): BelongsTo
    {
        return $this->belongsTo(CategoryParent::class,'cp_id');
    }
    public function SubCategory(): HasMany
    {
        return $this->hasMany(FerstSubCatigory::class,'cat_par_id');
    }
    public static function getSubCategories()
    {
        return static::pluck('fsc_id')->toArray();
    }
    public static function getByFscId($fscId)
    {
        return static::where('fsc_id', $fscId)->first();
    }
    public static function getCategoryNameById($categoryId)
    {
        return static::where('fsc_id', $categoryId)->value('name');
    }



}
