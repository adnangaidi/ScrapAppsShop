<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plans extends Model
{
    use HasFactory;
    protected $table='plans';

    protected $fillable=[
        'id',
        'name',
        'tarif_id'
    ];

    public function plan():BelongsTo
    {
        return $this->belongsTo(Tarif::class);
    }
     
}
