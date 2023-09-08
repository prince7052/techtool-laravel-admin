<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File_data;
use App\Models\User;






class DashboardsController extends Controller
{
    //

    public function index() {
        $data['authenticated_user'] = Auth::user();
        if($data['authenticated_user']->role_id == 1) {
            $count1 = File_data::count();
            $count2 = User::count();
            return view('admin.home', ['count1' => $count1,'count2' => $count2]); 
        } else {
            $dist = auth()->user()->distric;
            $count1 = File_data::where('Dest', $dist)->where('status', 1)->count();
            $count2 = File_data::where('Dest', $dist)->where('status', 0)->count();
            return view('user.home', ['count1' => $count1,'count2' => $count2]); 
        }
    }
}
