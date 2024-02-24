<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\list_apps;
use App\Models\FerstSubCatigory;
use App\Models\SecondSubCatigory;
use App\Traits\ScrapTrait;


class GetUrlsApps extends Command
{
    private $scrapTrait;
    public function __construct(ScrapTrait $scrapTrait)
    {
        parent::__construct();
        $this->scrapTrait = $scrapTrait;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apps:Link';

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

        $subcategories = FerstSubCatigory::getSubCategories();

        $secondSubCategories = SecondSubCatigory::getSubCategories();;

        foreach ($subcategories as $sub) {
            if (in_array($sub, $secondSubCategories)) {
                $this->handleSecondSubCategories($sub);
            } else {
                $this->handleFirstSubCategory($sub);
            }
        }

        $this->info('all apps have url');
    }

    private function handleSecondSubCategories($sub)
    {
        $seconds = SecondSubCatigory::getByFscId($sub);;

        foreach ($seconds as $second) {
            $this->handleSubCategory($second);
        }
    }

    private function handleFirstSubCategory($sub)
    {
        $category = FerstSubCatigory::getByFscId($sub);

        if ($category) {
            $this->handleSubCategory($category);
        }
    }

    private function handleSubCategory($category)
    {
        $categoryInfo = SecondSubCatigory::handle($category);
        $this->list_apps($category->url, $categoryInfo['nameCategoryParent'], $categoryInfo['nameFirstSub'], $categoryInfo['nameSecondSub']);
    }

    public function list_apps($url, $CategoryParent, $FirstSubCategory, $secondeSubCategory)
    {
        $results = $this->scrapTrait->executePythonScript('Script_python/categories/main.py', $url);
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
