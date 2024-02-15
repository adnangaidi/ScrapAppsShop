<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class list_apps extends Model
{
    use HasFactory;
    protected $table = 'list_apps';
    public $timestamps = true;
    protected $fillable=[
        'id',
        'url',
        'categories',
        'subcategories',
        'subcategories1',
        'status'
    ];
    public function apps():HasOne{
     return $this->hasOne(App::class);
    }
}
