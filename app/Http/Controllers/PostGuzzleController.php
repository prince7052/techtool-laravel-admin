<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class PostGuzzleController extends Controller
{


    public function index(Request $request){

        $client = new Client();

       $response = $client->post('https://niyochat.com/api/send', [
            'headers' => [
                'Cookie' => 'stackpost_session=n007uvlf4bfgtkj5jidoa5es4c9i4p7j',
            ],
            'form_params' => [
                'number' => '91'.$request->mobile_number,
                'type' => 'text',
                'message' => $request->message,
                'instance_id' => '64F1C6A69376E',
                'access_token' => '64f1c4e8e5af9',
            ],
        ]);

    
       return redirect()->route('media.whatsapp')->with('success', 'Message Send Successfully');
    }

}
