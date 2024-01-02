<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class list_apps extends Model
{
    use HasFactory;
    protected $table = 'list_apps';
    public $timestamps = true;
    protected $fillable=[
        'id',
        'url',
        'status'
    ];
}
