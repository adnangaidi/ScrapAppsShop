<?php

namespace App\Console\Commands;

use App\Http\Controllers\ChatgptController;
use App\Models\App;
use Illuminate\Console\Command;

class Chatgpt extends Command
{
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
        $controller = app(ChatgptController::class);
        $apps=App::all();
        foreach($apps as $app){
            $controller->feedbackChat($app['app_id']);
        }
        

    }
}
