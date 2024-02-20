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

                    $this->list_apps($second['url'], $nameCategoryParent, $nameFirstSub, $nameSecondSub);
                }
            } else {

                $category = FerstSubCatigory::where('fsc_id', $sub)->first();
                $nameCategoryParent = CategoryParent::where('cp_id', $category->cp_id)->value('name');
                $nameFirstSub = FerstSubCatigory::where('fsc_id', $category->fsc_id)->value('name');
                if ($category) {
                    $this->list_apps($category->url, $nameCategoryParent, $nameFirstSub, null);
                }
            }
        }

        return response()->json(['the list apps is save with successuful', 200]);
    }




    public function list_apps($url, $CategoryParent, $FirstSubCategory, $secondeSubCategory)
    {
        $path_script = storage_path('Script_python/categories/main.py');

        if (!file_exists($path_script)) {
            throw new \Exception("Python script not found at $path_script");
        }
        $res = shell_exec(env("PYTHON_PATH") . '"' . $path_script . '" "' . $url . '"');
        $results = json_decode($res, true);

        if ($results !== null) {
            for ($i = 0; $i < count($results); $i++) {
                $url_apps = new list_apps();
                $url_apps->url = $results[$i];
                $url_apps->categories = $CategoryParent;
                $url_apps->subcategories = $FirstSubCategory;

                if ($secondeSubCategory) {
                    $url_apps->subcategories1 = $secondeSubCategory;
                }
                $url_apps->status = 'not scraped';
                $url_apps->save();
            }
        }
    }
}
