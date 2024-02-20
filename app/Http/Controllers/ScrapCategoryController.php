<?php

namespace App\Http\Controllers;

use App\Models\CategoryParent;
use App\Models\FerstSubCatigory;
use App\Models\SecondSubCatigory;



class ScrapCategoryController extends Controller
{

    //function extract category parent
    public function CategoryParent()
    {
        $url = "https://apps.shopify.com/";
        $path_script = storage_path('Script_python/categories/script_category.py');
        if (!file_exists($path_script)) {
            throw new \Exception("Python script not found at $path_script");
        }
        $res = shell_exec(env("PYTHON_PATH") . ' "' . $path_script . '" "' . $url . '"');
        $results = json_decode($res, true);
        foreach ($results as $result) {
            if (isset($result['name']) && isset($result['href'])) {
                $category = new CategoryParent();
                $category->name = $result['name'];
                $category->url = $result['href'];
                $category->save();
            }
        }

        return true;
    }
    public function FirstSubCategory()
    {
        $category = CategoryParent::all();
        foreach ($category as $cat) {
            $path_script = storage_path('Script_python/categories/script_subcategory.py');
            if (!file_exists($path_script)) {
                throw new \Exception("Python script not found at $path_script");
            }
            $res = shell_exec(env("PYTHON_PATH") . '"' . $path_script . '" "' . $cat['url'] . '"');
            $results = json_decode($res, true);
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
        return true;
    }
    public function SecondSubCategory()
    {

        $category = FerstSubCatigory::all();
        foreach ($category as $cat) {
            $path_script = storage_path('Script_python/categories/script_subcategory.py');
            if (!file_exists($path_script)) {
                throw new \Exception("Python script not found at $path_script");
            }
            $res = shell_exec(env("PYTHON_PATH") . ' "' . $path_script . '" "' . $cat['url'] . '"');
            $results = json_decode($res, true);
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
