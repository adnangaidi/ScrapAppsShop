<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;

class ScrapTrait
{

    public function executePythonScript($scriptPath, $url)
    {
        try {
            // Construct the full path to the Python script
            $path_script = storage_path($scriptPath);
            // Check if the script file exists
            if (!file_exists($path_script)) {
                throw new Exception("Python script not found at $path_script");
            }
            // Construct the command to execute the Python script
            $command = env("PYTHON_PATH") . " \"$path_script\" \"$url\"";
            // Execute the command and capture the output
            $res = shell_exec($command);
            // Check if shell_exec() returned an error
            if ($res === null) {
                throw new Exception("Error executing Python script: $command");
            }
            // Decode the output as JSON
            $decoded_res = json_decode($res, true);
            return $decoded_res;
        } catch (Exception $e) {
            Log::error("Exception occurred while executing Python script: " . $e->getMessage());
            throw $e;
        }
    }


    public function removeQueryParams($url)
    {
        $parsedUrl = parse_url($url);

        if ($parsedUrl !== false) {
            $scheme   = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
            $host     = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';
            $path     = isset($parsedUrl['path']) ? $parsedUrl['path'] : '';
            return $scheme . $host . $path;
        }

        return false;
    }
}
