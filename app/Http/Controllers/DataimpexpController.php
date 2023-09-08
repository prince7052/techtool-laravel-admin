<?php

namespace App\Http\Controllers;


use App\Models\File_data;

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

class DataimpexpController extends Controller
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function index()
    {
        $users = File_data::with('roles')->paginate(10);
        if($users){
            return view('users.import-list', ['users' => $users]);
        }else{
             $users =" ";
            return view('users.import-list', ['users' => $users]);
        }
       
    }

   
    /**
     * @return \Illuminate\Support\Collection
     */
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function uploadUsers()
    {
        Excel::import(new UsersImport, request()->file('file'));

        //return back();
        return redirect()->route('users.import_list')->with('success', 'User Imported Successfully');
    }


    //
}
