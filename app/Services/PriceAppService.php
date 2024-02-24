<?php
namespace App\Services;
use Exception;
use App\Models\Price;
use App\Models\Plans;
use Illuminate\Support\Facades\Log;
use App\Traits\ScrapTrait;

class PriceAppService
{
    private $scrapTrait;
    public function __construct(ScrapTrait $scrapTrait)
    {
        $this->scrapTrait=$scrapTrait;
    }
    public function scrapeAndSavePrice($url, $app_id)
    {
        try {
            $result = $this->scrapTrait->executePythonScript('Script_python/info_app/script_tarif_app.py',$url);
            
            if ($result) {
                for ($i = 0; $i < count($result); $i++) {
                    $price = new Price();
                    $price->name = $result[$i]['name'];
                    $price->price = $result[$i]['price'];
                    $price->app_id = $app_id;
                    $price->save();

                    foreach ($result[$i]['plans'] as $planName) {
                        $plan = new Plans();
                        $plan->name = $planName;
                        $plan->price_id = $price->price_id;
                        $plan->save();
                    }
                    $price->setHidden(['plan']);
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
}
