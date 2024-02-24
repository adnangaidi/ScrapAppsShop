<?php
namespace App\Services;

use App\Models\Review;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Traits\ScrapTrait;

class ReviewAppService
{
    private $scrapTrait;
    public function __construct(ScrapTrait $scrapTrait)
    {
        $this->scrapTrait=$scrapTrait;
    }
    public function scrapeAndSaveReviews($url, $app_id)
    {
        try {
            $result = $this->scrapTrait->executePythonScript('Script_python/info_app/script_reviews.py',$url);

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
}
