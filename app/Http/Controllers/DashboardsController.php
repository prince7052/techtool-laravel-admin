<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\File_data;
use App\Models\Import_data;
use App\Models\User;
use Carbon\Carbon;







class DashboardsController extends Controller
{
    //

    public function index()
    {
        $data['authenticated_user'] = Auth::user();
        if ($data['authenticated_user']->role_id == 1) {
            $count1 = Import_data::count();

            $currentDate = Carbon::now()->toDateString();

            //return $currentDate;

           

            $count2 = Import_data::where('update_date', $currentDate)->where('status', 1)->count();


            $count4 = Import_data::where('follow_up', 1)->count();

            if($count4){
                $count4= $count4;
            }else{
                $count4 =0;
            }

            
            session::put('count1', $count1);
            session::put('count2', $count2);
            session::put('count4', $count4);

            $data = 0;
            $users = 0;

            $data1 = User::where('status',1)->get();

            $startDate = 0;
            $endDate = 0;
            $agent = 0;

            return view('admin.home', ['count1' => $count1, 'count2' => $count2, 'count4' => $count4,'data1'=>$data1,'users' => $users, 'data' => $data,'startDate'=>$startDate,'endDate'=>$endDate,'agent'=>$agent]);
        } else {
            $dist = auth()->user()->distric;
            $count1 = File_data::where('Dest', $dist)->where('status', 1)->count();
            $count2 = File_data::where('Dest', $dist)->where('status', 0)->count();

            session::put('count1', $count1);
            session::put('count2', $count2);

            return view('user.home', ['count1' => $count1, 'count2' => $count2]);
        }
    }
}
