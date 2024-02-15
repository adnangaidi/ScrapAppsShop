<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roles extends Model
{
    use HasFactory;
    protected $table="roles";
    protected $fillable = [
       'id',
       'name',
       'desc_id'
    ];

    public function Role():BelongsTo{
       return $this->belongsTo(Description::class);
    }
}
