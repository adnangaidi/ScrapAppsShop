<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class ScraperService
{
    public function scrape($url)
    {
        Log::info('Starting scraping process for ' . $url);
        $process = new Process(['python', 'Script_python\scrypt_info_app.py', $url]);
        $process->run();

        if (!$process->isSuccessful()) {
            Log::error($process->getErrorOutput());
            return null;
        }

        return response()->json(['output'=>$process->getOutput()]);
    }
}
