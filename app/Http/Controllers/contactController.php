<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactController extends Controller
{
    public function send(){
        $data=request()->validate([
            'firstName'=>'required|min:3',
            'lastName'=>'required|min:3',
            'email'=>'required|email',
            'phone'=>'required|numeric|digits:10',
            'message'=>'required|min:10',
        ]);
        
        Mail::to('adnanforsa@gmail.com')->send(new ContactUs($data));
        return redirect()->back()->with('message','Message sent successfully');
    }
}
