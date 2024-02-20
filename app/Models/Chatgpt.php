<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class Chatgpt extends Model
{
    use HasFactory;
    protected $table='openais';
    protected $fillable=[
        'id',
        'response',
        'app_id'
    ];

    public function app():BelongsTo{
        return $this(list_apps::class);
    }
}
