<?php 

namespace App\Services;
use OpenAI\Laravel\Facades\OpenAI;
class ChatgptService{
    public function feedbackChatgpt($contentReview){
        $result =  OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => 'This is a list of bad reviews for various Shopify apps from merchants. Could you analyze these reviews and provide insights into common pain points or missing features? Based on this analysis, could you suggest potential app ideas that address these issues or fulfill the unmet needs of Shopify merchants?' . $contentReview
                ],
            ],
        ]);
        return $result->choices[0]->message->content;
    }
}

