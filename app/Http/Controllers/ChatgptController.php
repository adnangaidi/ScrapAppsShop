<?php

namespace App\Http\Controllers;

use App\Models\Chatgpt ;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Review;


class ChatgptController extends Controller
{

    public function feedbackChat($app_id)
    {
        $badReviews = Review::where('app_id', '=', $app_id)->where('nb_start', '<=', 3)->get('content');

        $result =  OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'This is a list of bad reviews for various Shopify apps from merchants. Could you analyze these reviews and provide insights into common pain points or missing features? Based on this analysis, could you suggest potential app ideas that address these issues or fulfill the unmet needs of Shopify merchants?' . $badReviews[1]['content']
                ],
            ],
        ]);
         
        $open=new Chatgpt();
        $open->response=$result->choices[0]->message->content;
        $open->app_id=$app_id;
        $open->save();
        // print_r($result->choices[0]->message->content);
    }
}

