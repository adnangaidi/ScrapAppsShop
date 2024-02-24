<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class App extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = 'apps';
    protected $primaryKey = 'app_id';
    public $timestamps = true;
    protected $fillable = [
        'app_id',
        'name',
        'logo',
        'video',
        'developer',
        'date_created',
        'nb_review',
        'langue',
        'categories',
        'subcategories',
        'subcategories1',
        'slug',
        'id',
        'title',
        'body',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when(
            $filters['search'] ?? false,
            fn ($query, $search) =>
            $query->where('name', 'like', '%' . $search . '%')
        );
    }

    protected  function getAppsByCategories($categories)
    {

        $categoryApps = [];

        foreach ($categories as $category) {
            $categoryApps[] = static::where('categories', $category)
                ->where('nb_review', '<=', 200) 
                ->limit(16)
                ->get()
                ->toArray();
        }

        return   $categoryApps;
    }

    protected static function getSingleApp($slug)
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    protected  function getMedias($app)
    {
        $allmedia = [];
        $medias = $app->getMedia('media');
        $app['video'] != null ?  $allmedia[] = $app['video'] : '';
        foreach ($medias as $media) {
            $allmedia[] = substr($media['original_url'], 22);
        }
        return $allmedia;
    }


    public static function filterByCategories($category)
    {
        return static::where('categories', $category)->get();
    }
    public static function filterBySubCategories($subcategory)
    {
        return static::where('subcategories', $subcategory)->orWhere('subcategories1', $subcategory)->get();
    }
 public static function filterByDeveloper($developer)
    {
        return static::where('developer', $developer)->get();
    }

    public function listapps(): BelongsTo
    {
        return $this->belongsTo(list_apps::class);
    }

    public function price(): HasOne
    {
        return $this->hasOne(Price::class);
    }

    public function review(): HasMany
    {
        return $this->HasMany(Review::class);
    }
    public function roles(): HasMany
    {
        return $this->hasMany(Roles::class);
    }

    public function openai(): HasOne
    {
        return $this->hasOne(Chatgpt::class);
    }
}
