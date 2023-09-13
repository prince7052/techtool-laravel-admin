<?php

namespace App\Http\Controllers\Social_site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\User;


class whatsapp extends Controller
{
    //
    public function index()
    {

        return view('admin.social_site.whatsapp');
    }


    public function store(Request $request){

        $client = new Client();

        if(auth()->user()->role_id == 1) {

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

    }else{
       $email =  auth()->user()->email;
        $data1 = User::select('*')->where('email', $email)->first();

      
       

     
            $response = $client->post('https://niyochat.com/api/send', [
                'headers' => [
                    'Cookie' => 'stackpost_session=n007uvlf4bfgtkj5jidoa5es4c9i4p7j',
                ],
                'form_params' => [
                    'number' => '91'.$request->mobile_number,
                    'type' => 'text',
                    'message' => $request->message,
                    'instance_id' => $data1['InstanceID'],
                    'access_token' => $data1['AccessToken'],
                ],
            ]);
        

    }

    
       return redirect()->route('media.whatsapp')->with('success', 'Message Send Successfully');
    }

    public function send_msg(Request $request){

       

        $client = new Client();

      

       
            $email =  auth()->user()->email;
             $data1 = User::select('*')->where('email', $email)->first();
           
            
             if(($data1['InstanceID']!="") && ($data1['AccessToken']!="") ){
             $response = $client->post('https://niyochat.com/api/send', [
                 'headers' => [
                     'Cookie' => 'stackpost_session=n007uvlf4bfgtkj5jidoa5es4c9i4p7j',
                 ],
                 'form_params' => [
                     'number' => '91'.$request->mobile_number,
                     'type' => 'text',
                     'message' => $request->message,
                     'instance_id' => $data1['InstanceID'],
                     'access_token' => $data1['AccessToken'],
                 ],
             ]);
             return "1";  
            }else{
                return "0";
            }


    
     
    }
}
