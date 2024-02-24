<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class SecondSubCatigory extends Model
{
    use HasFactory;
    protected $table='second_sub_catigories';
    protected $primaryKey='ssc_id'; 
    protected $fillable=[
        'ssc_id',
        'name',
        'url',
        'cp_id',
        'fsc_id'
    ];

    public function SubCategories(): BelongsTo
    {
        return $this->belongsTo(FerstSubCatigory::class,'fsc_id');
    }
    public static function getSubCategories()
    {
        return static::pluck('fsc_id')->toArray();
    }
    public static function getByFscId($fscId)
    {
        return static::where('fsc_id', $fscId)->get();
    }

    public static function handle($category)
    {
        $nameCategoryParent = CategoryParent::getCategoryNameById($category->cp_id);
        $nameFirstSub = FerstSubCatigory::getCategoryNameById($category->fsc_id);
        $nameSecondSub = $category instanceof SecondSubCatigory ? SecondSubCatigory::where('ssc_id', $category->ssc_id)->value('name') : null;

        return [
            'nameCategoryParent' => $nameCategoryParent,
            'nameFirstSub' => $nameFirstSub,
            'nameSecondSub' => $nameSecondSub,
        ];
    }
}
