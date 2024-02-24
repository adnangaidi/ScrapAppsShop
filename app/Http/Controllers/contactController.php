<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Models\App;
class contactController extends Controller
{
    public function contact()
    {
        return Inertia::render('Contact',);
    }


    public function send(CreateContactRequest $request){
        $data= $request->validated();
        
        Mail::to('adnanforsa@gmail.com')->send(new ContactUs($data));
        return redirect()->back()->with('message','Message sent successfully');
    }
}
