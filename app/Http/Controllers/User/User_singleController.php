<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\File_data;
use App\Models\Dropdown_tbl;


use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class User_singleController extends Controller
{
    public function user_list()
    {
        $dist = auth()->user()->distric;
        $data = File_data::select('*')->where('Dest', $dist)->first();
        $users = File_data::where('Dest', $dist)->with('roles')->paginate(10);
       
            return view('user.user-list', ['users' => $users,'data'=>$data]);
       
    }


     

    public function one_data_update(Request $request)
    {

        
            $iid = $request->id;
            $list = $request->list;
            $email = auth()->user()->email;
            User::where('email', $email)->update(array('remark_status' => 1)); 
            File_data::where('id', $iid)->update(array('status' => 1,'list_option'=>$list));
            $dist = auth()->user()->distric;
            $user = File_data::select('*')->where('Dest', $dist)->where('status', 0)->first();
            $data = Dropdown_tbl::all();

            if ($user) {

                $previous = File_data::where('id', '<', $user->id)->max('id');
                $next = File_data::where('id', '>', $user->id)->min('id');

                return view('user.calling', ['users' => $user, 'next' => $next, 'prev' => $previous, 'data'=>$data]);
            } else {
                $user = " ";
                return view('user.calling', ['users' => $user,'data'=>$data]);
            }
       


           
        
    }

    public function one_data_lst()
    {
        
        $dist = auth()->user()->distric;
            $user = File_data::select('*')->where('Dest', $dist)->where('status', 0)->first();
            $data = Dropdown_tbl::all();

        if ($user) {

            $previous = File_data::where('id', '<', $user->id)->max('id');
            $next = File_data::where('id', '>', $user->id)->min('id');
          

            return view('user.calling', ['users' => $user, 'next' => $next, 'prev' => $previous, 'data'=>$data]);
        } else {
            $user = " ";
            return view('user.calling', ['users' => $user, 'data' => $data ]);
        }
    }

    public function complete_remark_list()
    {
      $dist = auth()->user()->distric;
      $data = File_data::select('*')->where('Dest', $dist)->first();
      $users = File_data::select('*')->where('Dest', $dist)->where('status', 1)->get();
      return view('user.complete-remark', ['users' => $users,'data' => $data]); 
      
    }

    public function pending_remark_list()
    {
      $dist = auth()->user()->distric;
      $data = File_data::select('*')->where('Dest', $dist)->first();
      $users = File_data::select('*')->where('Dest', $dist)->where('status', 0)->get();
      return view('user.pending-remark', ['users' => $users,'data' => $data]); 
      
    }

}
