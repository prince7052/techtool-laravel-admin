<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use App\Models\Import_data;

use Illuminate\Support\Facades\Auth;
use Validator;
use Carbon\Carbon;

class DashboardController extends BaseController
{
    public function dashboard($id){

        $user = Auth::user(); 
      
            $currentDate = Carbon::now()->toDateString();

           
             Import_data::where('agent_id', $id)->where('follow_up',1)->where('follow_up_date', $currentDate)->update(['follow_up' => 0,'status' => 0,'follow_up_date'=>" "]);
        
        

        $customers = Import_data::select('name','phone')->where('agent_id', $id)->where('status',0)->get();
      
        if( $customers){
            $success['customers'] =  $customers;
        }else{
            $success['customers'] =  'No record Found';
        }
       
        

        return $this->sendResponse($success, 'Assigned Record To you.');

    }

    public function update_record(Request $request,$id,$cid){

        $remark_option = " ";
        if($request->remark_option){
            $remark_option = $request->remark_option;
        }

        

        if($request->recorded_call){
            $recorded_call = time().'.'.$request->recorded_call->extension();  
     
            $request->recorded_call->move(public_path('uploads'), $recorded_call); 

            }else{
                $recorded_call = " ";
            }

        $follow_up_date = " ";
        $follow_up = 0;
        if($request->follow_up_date){
            $follow_up_date = $request->follow_up_date;
            $carbonDate = Carbon::parse($follow_up_date);
            $follow_up_date = $carbonDate->toDateString();
            $follow_up = 1;
        }

        $user = Auth::user(); 
        $currentDate = Carbon::now()->toDateString();
        Import_data::where('agent_id', $id)->where('id', $cid)->update(['status' => 1,'remark_option'=>$remark_option,'recorded_call'=>$recorded_call,'follow_up_date'=>$follow_up_date,'follow_up'=>$follow_up,'update_date'=> $currentDate]);
        $remainings = Import_data::select('*')->where('agent_id', $id)->where('status', 0)->count();

        if( $remainings == 0){
            Import_data::where('agent_id', 'all')->take('10')->update(['agent_id' => $id]);
        }

        $customers = Import_data::select('name','phone')->where('agent_id', $id)->where('status',0)->get();
        if( $customers){
            $success['customers'] =  $customers;
        }else{
            $success['customers'] =  'No record Found';
        }
       
        

        return $this->sendResponse($success, 'Left Records .');

    }

    public function follow_up($id){

        $user = Auth::user(); 
        $follow_up_customers = Import_data::select('name','phone','follow_up_date')->where('agent_id', $id)->where('follow_up',1)->get();
      
        if( $follow_up_customers){
            $success['follow_up_customers'] =  $follow_up_customers;
        }else{
            $success['follow_up_customers'] =  'No record Found';
        }
       
        

        return $this->sendResponse($success, 'These are Follow up records ');

    }
}
