<?php

namespace App\Services;

use App\Traits\ScrapTrait;
use App\Models\App;
use App\Http\Resources\MediaResource;
use App\Models\Roles;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Support\Facades\Log;


class InfoAppService
{
    use InteractsWithMedia;
    private $scrapTrait;
    private $imageAppService;
    public $name;
    public function __construct(ImageAppService $imageAppService, ScrapTrait $scrapTrait)
    {
        $this->scrapTrait = $scrapTrait;
        $this->imageAppService = $imageAppService;
        $this->name = '';
    }

    public function scrapAndSaveAppInfo($url, $categories, $subcategories, $subcategories1, $id)
    {
        try {
            $result = $this->scrapTrait->executePythonScript('Script_python/info_app/script_info_app.py', $url);
            if ($result) {
                $resultDescription = $this->scrapTrait->executePythonScript('Script_python/info_app/script_desc_app.py', $url);
                $info_app = new App();
                $info_app->name   = $result['name_app'];
                $this->name = $result['name_app'];
                $info_app->developer   = $result['developer'];
                $info_app->nb_review   = $result['number_avis'];
                $info_app->date_created   = $result['date_created'];
                $info_app->langue   = $result['langues'];
                $info_app->categories   = $categories;
                $info_app->subcategories   = $subcategories;
                $info_app->subcategories1 = $subcategories1;
                $info_app->title = $resultDescription['title'];
                $info_app->body = $resultDescription['body'];
                /** for slug */
                $slug = "$categories $subcategories $subcategories1 " . $result['name_app'];
                $info_app->slug = Str::slug($slug);
                $info_app->id = $id;
                if ($result['link_logo']) {
                    $media = collect($result['link_logo'])
                        ->map(function ($url_logo) use ($info_app) {
                            return $info_app->addMediaFromUrl($url_logo)->toMediaCollection('logo_app');
                        });
                    MediaResource::collection($media);
                }
                $info_app->save();
                $id = $info_app->app_id;
                $this->saveRoles($resultDescription['role'],$id);
                $file = DB::table('media')->where('model_id', $id)->where('collection_name', 'logo_app')->first();
                if ($file) {
                    $path = "media/{$file->id}/{$file->file_name}";
                    $info_app->logo = $path;
                }
                $this->imageAppService->scrapeAndSaveImages($url, $info_app);
                $info_app->save();
            } else {
                return response()->json([
                    'message' => 'error saving data',
                ]);
            }
        } catch (Exception $e) {
            Log::error("error the scrap this url $e");
        }

        return response()->json(['the info is save with successuful', 200]);
    }
    public function saveRoles($results, $id)
    {
        foreach ($results as $roleName) {
            $role = new Roles();
            $role->name = $roleName;
            $role->app_id = $id;
            $role->save();
        }
    }
}
