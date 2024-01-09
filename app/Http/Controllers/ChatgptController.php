<?php

namespace App\Http\Controllers;

use App\Models\list_apps;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use App\Models\Review;


class ChatgptController extends Controller
{
    
    public function feedbackChat($app_id){
        $badreviews = Review::where('app_id','=', $app_id)->where('nb_start','<=',3)->get('content');
   
        $result =  OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'user', 'content' => 'whate is your feedback about this review:'.$badreviews[1]['content']],
            ],
        ]);
        
        //Log::info($result->choices[0]->message->content);
        print_r($result->choices[0]->message->content);
    
    }
    public function addata(){
        $data=[
            'url'=>'https://apps.shopify.com/beacon?st_source=autocomplete',
            'status'=>'not scraped'
        ];
        $list_apps=new list_apps($data);
        $list_apps->save();
        return 'data add with successfule';
    }
}
