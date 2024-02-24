<?php

namespace App\Services;

use App\Models\App;
use Illuminate\Support\Facades\Log;

class HomeService
{
    public function getHomeApps()
    {
        $categories = [
            'Finding products',
            'Selling products',
            'Orders and shipping',
            'Store design',
            'Store management',
            'Marketing and conversion',
        ];

        $appsByCategory = App::getAppsByCategories($categories);

        return $appsByCategory;
    }

    


}
