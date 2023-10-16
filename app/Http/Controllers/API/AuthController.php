<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Import_data;

use Illuminate\Support\Facades\Auth;
use Validator;

class AuthController extends BaseController
{
       /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
 
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {

        
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
           // $customers = Import_data::where('agent_id', $user->id)->where('status',0)->get();
            $success['token'] =  $user->createToken('MyApp')->plainTextToken;
            $success['name'] =  $user->name;
           /* if( $customers){
                $success['customers'] =  $customers;
            }else{
                $success['customers'] =  'No record Found';
            }*/
           
            
   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function dashboard($id){

        $user = Auth::user(); 
        $customers = Import_data::where('agent_id', $id)->where('status',0)->get();
      
        if( $customers){
            $success['customers'] =  $customers;
        }else{
            $success['customers'] =  'No record Found';
        }
       
        

        return $this->sendResponse($success, 'Assigned Record To you.');

    }
}
