<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Description;
use Exception;
use App\Http\Resources\MediaResource;
use App\Models\Plans;
use App\Models\Tarif;
use Illuminate\Support\Facades\Log;
use App\Models\Review;
use App\Models\Roles;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;



class ScrapController extends Controller
{
    use InteractsWithMedia;
    public $name = '';
    //call all functions scrap
    public function getdata($url, $categories, $subcategories, $subcategories1, $id)
    {
        set_time_limit(0);

        $info = $this->info_app($url, $categories, $subcategories, $subcategories1, $id);
        try {
            Log::info($info->getStatusCode());
            if ($info->getStatusCode() == 200) {
                $app_id = App::where('name', $this->name)->value('app_id');
                Log::info($app_id);
                if ($app_id != null) {
                    $this->desc_app($url, $app_id);
                    $this->tarif_app($url, $app_id);
                    Log::info($this->removeQueryParams($url));
                    $this->review_app($this->removeQueryParams($url), $app_id);
                } else {
                    return 'the id of app is null';
                }
            }
            return 'data saved with successful';
        } catch (Exception $e) {
            Log::error("error the scrap this url $e");
        }
    }

    public function info_app($url, $categories, $subcategories, $subcategories1, $id)
    {
        try {
            $path_script = storage_path('Script_python/info_app/script_info_app.py');
            if (!file_exists($path_script)) {
                throw new \Exception("Python script not found at $path_script");
            }

            $res = shell_exec(env("PYTHON_PATH") . '"' . $path_script . '" "' . $url . '"');
            $result = json_decode($res, true);

            if ($result) {
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
                /** for slug */
                $sl = "$categories $subcategories $subcategories1 " . $result['name_app'];
                $info_app->slug = Str::slug($sl);
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

                $file = DB::table('media')->where('model_id', $id)->where('collection_name', 'logo_app')->first();

                if ($file) {
                    $path = "media/{$file->id}/{$file->file_name}";
                    $info_app->logo = $path;
                }
                $this->image_app($url, $info_app);
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

    public function image_app($url, $info_app)
    {
        try {
            $path_script = storage_path('Script_python/info_app/script_image.py');
            if (!file_exists($path_script)) {
                throw new \Exception("Python script not found at $path_script");
            }
            $res = shell_exec(env("PYTHON_PATH") . '"' . $path_script . '" "' . $url . '"');
            $result = json_decode($res, true);
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

    public function desc_app($url, $app_id)
    {
        try {
            $path_script = storage_path('Script_python/info_app/script_desc_app.py');
            if (!file_exists($path_script)) {
                throw new \Exception("Python script not found at $path_script");
            }
            $res = shell_exec(env("PYTHON_PATH") . '"' . $path_script . '" "' . $url . '"');
            $result = json_decode($res, true);
            $desc_app = new Description();
            $desc_app->title = $result['title'];
            $desc_app->body = $result['body'];
            $desc_app->app_id = $app_id;
            $desc_app->save();
            $id = $desc_app->id;

            foreach ($result['role'] as $roleName) {
                $role = new Roles();
                $role->name = $roleName;
                $role->desc_id = $id;
                $role->save();
            }
            // Exclude Roles model from JSON serialization
            $desc_app->setHidden(['roles']);
        } catch (Exception $e) {
            Log::error("error the scrap this url $e");
        }

        return response()->json([
            'message' => 'Description saved successfully.',
        ], 200);
    }

    public function tarif_app($url, $app_id)
    {
        try {
            $path_script = storage_path('Script_python/info_app/script_tarif_app.py');
            if (!file_exists($path_script)) {
                throw new \Exception("Python script not found at $path_script");
            }
            $res = shell_exec(env("PYTHON_PATH") . '"' . $path_script . '" "' . $url . '"');
            $result = json_decode($res, true);
            if ($result) {
                for ($i = 0; $i < count($result); $i++) {
                    $tarif_app = new Tarif();
                    $tarif_app->name = $result[$i]['name'];
                    $tarif_app->price = $result[$i]['price'];
                    $tarif_app->app_id = $app_id;
                    $tarif_app->save();
                    $id = $tarif_app->id;

                    foreach ($result[$i]['plans'] as $planName) {
                        Log::info("name plan", [$planName]);
                        $plan = new Plans();
                        $plan->name = $planName;
                        $plan->tarif_id = $id;
                        $plan->save();
                        Log::info("plan", [$plan]);
                    }
                    $tarif_app->setHidden(['plan']);
                }
            } else {

                return response()->json([
                    'message' => 'price none.',
                ], 400);
            }
        } catch (Exception $e) {
            Log::error("error the scrap this url $e");
        }

        return response()->json([
            'message' => 'Price saved successfully.',
        ], 200);
    }

    public function review_app($url, $app_id)
    {
        try {
            $path_script = storage_path('Script_python/info_app/script_reviews.py');
            if (!file_exists($path_script)) {
                throw new \Exception("Python script not found at $path_script");
            }
            $res = shell_exec(env("PYTHON_PATH") . '"' . $path_script . '" "' . $url . '"');
            $result = json_decode($res, true);
            if ($result) {
                for ($i = 0; $i < count($result); $i++) {
                    $review_app = new Review();
                    $review_app->store = $result[$i]['store'];
                    $review_app->contry = $result[$i]['contry'];
                    $review_app->date = $result[$i]['date'];
                    $review_app->nb_start  = $result[$i]['num_start'];
                    $review_app->content  = $result[$i]['content'];
                    $review_app->used_period = $result[$i]['used_period'];
                    $review_app->reply = $result[$i]['reply'];
                    $review_app->date_reply = $result[$i]['date_reply'];
                    $review_app->app_id = $app_id;
                    $review_app->save();
                }
            }
        } catch (Exception $e) {
            Log::error("error the scrap this url $e");
        }
        return response()->json([
            'message' => 'reviews saved successfully.',
        ], 200);
    }

    public function removeQueryParams($url)
    {
        $parsedUrl = parse_url($url);

        if ($parsedUrl !== false) {
            $scheme   = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
            $host     = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';
            $path     = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
            return $scheme . $host . $path;
        }

        return false;
    }
}
