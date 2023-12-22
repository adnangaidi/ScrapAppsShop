<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Description;
use Illuminate\Http\Request;
use Exception;
use App\Http\Resources\MediaResource;
use App\Models\Tarif;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UploadMediaRequest;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Support\Facades\DB;



class ScrapController extends Controller 
{
use InteractsWithMedia;
   public $name='';
//call all functions scrap
    public function getdata(Request  $request)
    {
        
    //for path the functipn app_path not work in this
        $url = $request->input('url');
        $info=$this->info_app($url) ;
        try {
            Log::info($info->getStatusCode());
            if($info->getStatusCode()==200){

                $app_id = App::where('name', $this->name)->value('app_id');
                Log::info($app_id);
                if ($app_id != null) {
                    $this->desc_app($url,$app_id);
                $this->tarif_app($url,$app_id);
                // $this->rev_app($url);
                }
                else{
                    return 'the id of app is null';
                }
            } 
            return 'data saved with successuful';
        } catch (Exception $e) {
            Log::error("error the scrap this url $e");
        }
    }

    public function info_app($url)
    {
        $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/script_info_app.py" "' . $url . '"');
        $result = json_decode($res, true);
        Log::info("result",$result);
        if($result){

         $info_app= new App();
         $info_app->name   =$result['name_app'];
         $this->name=$result['name_app'];
         $info_app->developer   =$result['developer'];
         $info_app->nb_review   =$result['nombre_avis'];
         $info_app->date_created   =$result['date_created'];
         $info_app->langue   =$result['langue'];
         $info_app->categories   =is_array($result['cat']) ? implode(', ', $result['cat']) : $result['cat'];
         if ($result['link_logo']) {
            $media = collect($result['link_logo'])
                ->map(function ($url_logo) use ($info_app) {
                    $path = 'public/media/' . basename($url_logo);
                    $info_app->logo=$path;
                    return $info_app->addMediaFromUrl($url_logo)->toMediaCollection('logo_app');
                });
                
             MediaResource::collection($media);
        }
        $this->image_app($url,$info_app);
        $info_app->save();
        }else
        {
            return response()->json([
                'message' => 'error saving data',
            ]);
        }

         return response()->json(['the info is save with successuful',200]);
    }

    public function image_app($url,$info_app)
    {
        $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/script_image.py" "' . $url . '"');
        $result = json_decode($res, true);
        
        Log::info($result);
        // check the url is from youtube, *********the index 0 is for src youtube*********
    if($result){
        for ($i = 0; $i < count($result); $i++) {
            if ($i == 0) {
                if(strpos($result[$i], 'youtube-nocookie.com')){
                    $info_app->video = $result[$i]; 
                }else{
                    $media = collect($result[$i])
                    ->map(function ($url_logo) use ($info_app) {
                        return $info_app->addMediaFromUrl($url_logo)->toMediaCollection('media');
                    });
                 MediaResource::collection($media);
                }
    
            } else {
                $media = collect($result[$i])
                ->map(function ($url_logo) use ($info_app) {
                    return $info_app->addMediaFromUrl($url_logo)->toMediaCollection('media');
                });
    
             MediaResource::collection($media);
            }
        }
    }else{

            return response()->json([
                'message' => 'error saving data',
            ]);
        
    }

    return response()->json(['the info is save with successuful',200]);
}

public function desc_app($url,$app_id)
{
    $res = shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/script_desc_app.py" "' . $url . '"');
    $result = json_decode($res, true);
    Log::info($result);

    // if ($app) {
    //     $app=$app;
    // }else{
    //     return response()->json([
    //         'message' => 'App not found for the given description.',
    //     ], 404);
    // }

    $desc_app = new Description();
    $desc_app->title = $result['title'];
    $desc_app->body = $result['body'];
    $desc_app->role = is_array($result['role']) ? implode(', ', $result['role']) : $result['role'];
    $desc_app->app_id= $app_id;

    $desc_app->save();

    return response()->json([
        'message' => 'Description saved successfully.',
    ], 200);
}

    public function tarif_app($url,$app_id)
{
    $res = shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/script_tarif_app.py" "' . $url . '"');
    $result = json_decode($res, true);
    Log::info(count($result));

    

    for ($i = 0; $i < count($result); $i++) {
        $tarif_app = new Tarif();
        $tarif_app->name = $result[$i]['name'];
        $tarif_app->price = $result[$i]['price'];
        $tarif_app->plan  = is_array($result[$i]['plans']) ? implode(', ', $result[$i]['plans']) : $result[$i]['plans'];
        $tarif_app->app_id= $app_id;
        $tarif_app->save();
    }
    return response()->json([
        'message' => 'Tarif saved successfully.',
    ], 200);
}

    public function rev_app($url)
    {
          $res=shell_exec('C:/PYTHON/python.exe "d:/stage/Nouveau dossier/appscrap/app/Script_python/script_tarif_app.py" "' . $url . '"');
        $result = json_decode($res, true);
        print_r($result[0]['plans'][0]) ; 
    }


    
    public function deleteE(){
        DB::table('media')->truncate();
        DB::table('apps')->truncate();
        DB::table('tarifs')->truncate();
        DB::table('descriptions')->truncate();

        return 'data delete with success';
    }
}
