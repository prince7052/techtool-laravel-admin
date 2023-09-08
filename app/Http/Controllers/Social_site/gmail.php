<?php

namespace App\Http\Controllers\Social_site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\MyTestMail;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class gmail extends Controller
{
    //

    public function index()
    {

        return view('admin.social_site.gmail');
    }

    public function store(Request $request){



        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => $request->message
        ];
       
        \Mail::to($request->email)->send(new \App\Mail\MyTestMail($details));
       
       // dd("Email is Sent.");


        return redirect()->route('media.mail')->with('success', 'Mail Send Successfully');

    }

}
