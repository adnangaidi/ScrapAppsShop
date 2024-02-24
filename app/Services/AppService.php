<?php 


namespace App\Services;

use App\Models\App;
use App\Models\Roles;
use App\Models\Price;
use App\Models\Plans;
use App\Models\list_apps;
use Illuminate\Support\Facades\Log;

class AppService
{
    public function getAppData($slug)
    {
        try {
            $app = App::getSingleApp($slug);
            $roles=Roles::getRoles($app['app_id']);
            $price = $this->getPricesAndPlan($app['app_id']);
            $url = list_apps::getAppUrl($app['id']);
            $media = App::getMedias($app);
            return ['app'=>$app,'role'=>$roles,'price'=>$price,'url'=>$url,'media'=>$media];
        } catch (\Exception $e) {
            Log::error("Error in getApp: " . $e->getMessage());
            abort(404);
        }
    }

    protected function getPricesAndPlan($appId)
    {
        $prices = Price::getPrices($appId);
        $result_price = [];

        foreach ($prices as $price) {
            $plan = Plans::getPlans($price['price_id']);
            $value = [
                "name" => $price['name'],
                "price" => str_replace('/month', '', $price['price']),
                "plan" => $plan,
            ];
            $result_price[] = $value;
        }

        return $result_price;
    }


}


