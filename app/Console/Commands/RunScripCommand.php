<?php

namespace App\Console\Commands;

use App\Http\Controllers\ScrapController;
use App\Models\list_apps;
use Illuminate\Console\Command;
class RunScripCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'script:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a script python';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $lists_apps=list_apps::where('status','not scraped')->get();
        for($i=0;$i<count($lists_apps);$i++){
           $controller=app(ScrapController::class);
           $controller->getdata($lists_apps[$i]['url']);
        //    $list_apps=list_apps;
           $res=list_apps::find($lists_apps[$i]['id']);
           $res->status= 'scraped';
           $res->save();
        }

    }
}
