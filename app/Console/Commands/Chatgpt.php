<?php

namespace App\Console\Commands;

use App\Http\Controllers\ChatgptController;
use App\Models\App;
use App\Models\Review;
use App\Services\ChatgptService;
use Illuminate\Console\Command;
use App\Models\Chatgpt;

class ChatFeedback extends Command
{

    protected $chatgpt;
    public function __construct(ChatgptService $chatgpt)
    {
        $this->chatgpt = $chatgpt;
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:chatgpt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
 
        $apps=App::all();
        foreach($apps as $app){
            $badReviews = Review::getReview($app['app_id']);
        $open = new Chatgpt();
        $open->response = $this->chatgpt->feedbackChatgpt($badReviews);
        $open->app_id = $app['app_id'];
        $open->save();
        }
        

    }
}
