<?php

namespace App\Http\Controllers;


use App\Models\File_data;

use App\Models\User;
use App\Exports\UsersExport;
use App\Exports\RecordsExport;
use App\Imports\UsersImport;
use App\Models\Import_data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;


class DataimpexpController extends Controller
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        $users = File_data::with('roles')->paginate(10);
        if ($users) {
            return view('users.import-list', ['users' => $users]);
        } else {
            $users = " ";
            return view('users.import-list', ['users' => $users]);
        }
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function export($id)
    {
        return Excel::download(new UsersExport($id), 'customers.xlsx');
    }


     /**
     * @return \Illuminate\Support\Collection
     */
    public function record_export($id,$sdt,$edt)
    {
        return Excel::download(new RecordsExport($id,$sdt,$edt), 'customersByFilter.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function uploadUsers(Request $request)
    {

        $currentDate = Carbon::now()->toDateString();
       
        $request->merge(['currentDate' => $currentDate]);

        $currentDateval = $request->input('currentDate');

        $requestData = $request->all();
        
        

        Excel::import(new UsersImport(), request()->file('file'));

      if($request->user_id == 'all'){

        $users = User::where('status',1)->where('role_id',2)->count();
        $record = Import_data::where('agent_id','all')->count();
        $recordsPerUser =  $record / $users;
        $offsets = 0;
        $data = User::where('status',1)->where('role_id',2)->get();

        foreach($data as $data){
           Import_data::where('agent_id','all')->skip($offsets)->take($recordsPerUser)->update(['agent_id'=>$data->id]);
           $offsets = 2*$recordsPerUser;
        }

      }

        return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }


  
}
