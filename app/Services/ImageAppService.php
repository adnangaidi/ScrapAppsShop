<?php
namespace App\Services;

use App\Traits\ScrapTrait;
use App\Http\Resources\MediaResource;
use Exception;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\InteractsWithMedia;



class ImageAppService
{
    use InteractsWithMedia;
    private $scrapTrait;
    public function __construct(ScrapTrait $scrapTrait)
    {
        $this->scrapTrait=$scrapTrait;
    }
    public function scrapeAndSaveImages($url, $info_app)
    {
        try {
            $result = $this->scrapTrait->executePythonScript('Script_python/info_app/script_image.py',$url);

            // check the url is from youtube, *********the index 0 is for src youtube*********
            if ($result) {
                for ($i = 0; $i < count($result); $i++) {
                    if (strpos($result[$i], 'youtube-nocookie.com')) {
                        $info_app->video = $result[$i];
                    } else {
                        $media = collect($result[$i])
                            ->map(function ($url_logo) use ($info_app) {
                                return $info_app->addMediaFromUrl($url_logo)->toMediaCollection('media');
                            });
                        MediaResource::collection($media);
                    }
                }
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
}
