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
}
