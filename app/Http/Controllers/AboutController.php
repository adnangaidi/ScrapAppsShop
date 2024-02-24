<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\App;

class AboutController extends Controller
{
    public function about()
    {
        $apps = App::all();
        return Inertia::render('About', [
            'apps' => $apps,
        ]);
    }
}
