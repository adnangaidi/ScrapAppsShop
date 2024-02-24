<?php

namespace App\Services;

use App\Models\CategoryParent;
use App\Models\FerstSubCatigory;
use App\Models\SecondSubCatigory;
use App\Traits\ScrapTrait;
use Exception;
use Illuminate\Support\Facades\Log;

class ScrapCategoriesService
{

    protected $scrapTrait;
    public function __construct(ScrapTrait $scrapTrait)
    {
        $this->scrapTrait = $scrapTrait;
    }

    public function CategoryParent()
    {
        $url = "https://apps.shopify.com/";
        $results = $this->scrapTrait->executePythonScript('Script_python/categories/script_category.py', $url);
        Log::info($results);
        if ($results) {
            foreach ($results as $result) {
                if (isset($result['name']) && isset($result['href'])) {
                    $category = new CategoryParent();
                    $category->name = $result['name'];
                    $category->url = $result['href'];
                    $category->save();
                }
            }
        }
        return true;
    }

    public function FirstSubCategory()
    {
        $category = CategoryParent::all();
        foreach ($category as $cat) {
            $results = $this->scrapTrait->executePythonScript('Script_python/categories/script_subcategory.py', $cat['url']);
            if ($results) {
                foreach ($results as $result) {
                    if (isset($result['name']) && isset($result['href'])) {
                        $firstcategory = new FerstSubCatigory();
                        $firstcategory->name = $result['name'];
                        $firstcategory->url = $result['href'];
                        $firstcategory->cp_id = $cat->cp_id;
                        $firstcategory->save();
                    }
                }
            }
        }
        return true;
    }
    public function SecondSubCategory()
    {

        $category = FerstSubCatigory::all();
        foreach ($category as $cat) {
            $results = $this->scrapTrait->executePythonScript('Script_python/categories/script_subcategory.py', $cat['url']);
            if ($results !== null) {
                foreach ($results as $result) {
                    if ($result !== null) {
                        if (isset($result['name']) && isset($result['href'])) {
                            $secondcategory = new SecondSubCatigory();
                            $secondcategory->name = $result['name'];
                            $secondcategory->url = $result['href'];
                            $secondcategory->cp_id = $cat->cp_id;
                            $secondcategory->fsc_id = $cat->fsc_id;
                            $secondcategory->save();
                        }
                    }
                }
            }
        }
    }
}
