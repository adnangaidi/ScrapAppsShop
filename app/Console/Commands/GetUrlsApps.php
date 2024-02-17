<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\list_apps;
use App\Models\CategoryParent;
use App\Models\FerstSubCatigory;
use App\Models\SecondSubCatigory;
use Illuminate\Support\Facades\Log;


class GetUrlsApps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apps:getUrls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for get URLs apps';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        set_time_limit(0);

        $subcategories = FerstSubCatigory::pluck('fsc_id')->toArray();

        $secondSubCategories = SecondSubCatigory::pluck('fsc_id')->toArray();

        foreach ($subcategories as $sub) {

            if (in_array($sub, $secondSubCategories)) {

                $seconds = SecondSubCatigory::where('fsc_id', $sub)->get();

                foreach ($seconds as $second) {

                    $nameCategoryParent = CategoryParent::where('cp_id', $second['cp_id'])->value('name');
                    $nameFirstSub = FerstSubCatigory::where('fsc_id', $second['fsc_id'])->value('name');
                    $nameSecondSub = SecondSubCatigory::where('ssc_id', $second['ssc_id'])->value('name');
                    $url = $second['url'];
                    $path_script = storage_path('Script_python/categories/main.py');
                    
                    if (!file_exists($path_script)) {
                        throw new \Exception("Python script not found at $path_script");
                    }
                    $res = shell_exec('C:/PYTHON/python.exe "' . $path_script . '" "' . $url . '"');
                    $results = json_decode($res, true);

                    if ($results !== null) {
                        for ($i = 0; $i < count($results); $i++) {
                            $url_apps = new list_apps();
                            $url_apps->url = $results[$i];
                            $url_apps->categories = $nameCategoryParent;
                            $url_apps->subcategories = $nameFirstSub;
                            $url_apps->subcategories1 = $nameSecondSub;
                            $url_apps->status = 'not scraped';
                            $url_apps->save();
                            Log::info($url_apps);
                        }
                    }
                }
            } 
            else {

                $category = FerstSubCatigory::where('fsc_id', $sub)->first();
                $nameCategoryParent = CategoryParent::where('cp_id', $category->cp_id)->value('name');
                $nameFirstSub = FerstSubCatigory::where('fsc_id', $category->fsc_id)->value('name');
                if ($category) {
                    $url = $category->url;
                    $path_script = storage_path('Script_python/categories/main.py');

                    if (!file_exists($path_script)) {
                        throw new \Exception("Python script not found at $path_script");
                    }
                    $res = shell_exec('C:/PYTHON/python.exe "' . $path_script . '" "' . $url . '"');
                    $results = json_decode($res, true);

                    if ($results !== null) {
                        for ($i = 0; $i < count($results); $i++) {
                            $url_apps = new list_apps();
                            $url_apps->url = $results[$i];
                            $url_apps->categories = $nameCategoryParent;
                            $url_apps->subcategories = $nameFirstSub;
                            $url_apps->status = 'not scraped';
                            $url_apps->save();
                            Log::info($url_apps);
                        }
                    }
                }
            }
        }

        return response()->json(['the list apps is save with successuful', 200]);
    }
}
