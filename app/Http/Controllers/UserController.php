<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\File_data;
use App\Models\Dropdown_tbl;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store', 'updateStatus']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['delete']]);
    }


    /**
     * List User 
     * @param Nill
     * @return Array $user
     * @author Shani Singh
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('users.index', ['users' => $users]);
    }

    public function dropdown_manage()
    {
        //  $users = User::with('roles')->paginate(10);
        $data = Dropdown_tbl::all();

        return view('users.dropdown-manage',['data'=>$data]);
    }

    public function posts_users(Request $request)
    {
        $data = User::select('*')->where('id',$request->id)->first();   
       

        return view('users.whatsapp-single-token', ['user' => $data]);
    }

    public function whatsapp_token()
    {
        $data = User::where('role_id',2)->get();

        return view('users.whatsapp-token', ['data' => $data]);
    }

    public function update_token(Request $request)
    {
       $id =  $request->id;
       $user_updated = User::whereId($id)->update([
        'InstanceID'        => $request->InstanceID,
        'AccessToken'        => $request->AccessToken,
    ]);
       

    return redirect()->route('users.whatsapp-token')->with('success', ' Updated data Successfully.');
    }


    public function option_store(Request $request)
    {

        Dropdown_tbl::truncate(); 
        $names = $request->get('name');
        $uid = auth()->user()->id;

       // print_r($names);
       // dd('====');
        $max = count($names);
       for ($x = 0; $x < $max; $x++) {
        if( $names[$x] != ""){

        Dropdown_tbl :: create([
            'user_id' => $uid,
            'option' => $names[$x]
       
        ]);
    }

        }
        return redirect()->route('users.dropdown-manage')->with('success', ' Added data Successfully.');

    }


    public function delete_option($id)
    {
      
            // Delete User
            Dropdown_tbl::where('id',$id)->delete(); 

           return redirect()->route('users.dropdown-manage')->with('success', ' Deleted data Successfully.');
        
    }

    public function remark_list()
    {
        $users = User::where('remark_status', 1)->with('roles')->paginate(10);
        // $users2 = User::where('remark_status',1)->get();

        foreach ($users as  $users1) {
            $data1[] = $users1->full_name;
            $data2[] = $users1->email;
            $data3[] = $users1->mobile_number;
            $data4[] = $users1->distric;
            $data5[] = File_data::where('Dest', $users1->distric)->where('status', 1)->count();
            $data6[] = File_data::where('Dest', $users1->distric)->where('status', 0)->count();
        }
        return view('users.remark_list', ['data1' => $data1, 'data2' => $data2, 'data3' => $data3, 'data4' => $data4, 'data5' => $data5, 'data6' => $data6,'users' => $users]);
    }


    public function user_remark_list($distt)
    {
        $dist = $distt;
        $data = File_data::select('*')->where('Dest', $dist)->first();
        $users = File_data::where('Dest', $dist)->where('status', 1)->with('roles')->paginate(10);

        return view('users.user-remark-list', ['users' => $users, 'data' => $data]);
    }

    public function pending_remark_list($distt)
    {
        $dist = $distt;
        $data = File_data::select('*')->where('Dest', $dist)->first();
        $users = File_data::where('Dest', $dist)->where('status', 0)->with('roles')->paginate(10);

        return view('users.pending-remark-list', ['users' => $users, 'data' => $data]);
    }

    /**
     * Create User 
     * @param Nill
     * @return Array $user
     * @author Shani Singh
     */
    public function create()
    {
        $roles = Role::all();
        $data = File_data::all();

        return view('users.add', ['roles' => $roles, 'data' => $data]);
    }

    /**
     * Store User
     * @param Request $request
     * @return View Users
     * @author Shani Singh
     */
    public function store(Request $request)
    {
        // Validations
       // print_r('<pre>');
       // print_r($request);

      //  dd('==========');
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|unique:users,email',
            'mobile_number' => 'required|numeric|digits:10',
            'role_id'       =>  'required|exists:roles,id',
            'status'       =>  'required|numeric|in:0,1',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $user = User::create([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'role_id'       => $request->role_id,
                'status'        => $request->status,
                'distric'       => $request->distric,
                'password'      => Hash::make($request->password)
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User Created Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Update Status Of User
     * @param Integer $status
     * @return List Page With Success
     * @author Shani Singh
     */
    public function updateStatus($user_id, $status)
    {
        // Validation
        $validate = Validator::make([
            'user_id'   => $user_id,
            'status'    => $status
        ], [
            'user_id'   =>  'required|exists:users,id',
            'status'    =>  'required|in:0,1',
        ]);

        // If Validations Fails
        if ($validate->fails()) {
            return redirect()->route('users.index')->with('error', $validate->errors()->first());
        }

        try {
            DB::beginTransaction();

            // Update Status
            User::whereId($user_id)->update(['status' => $status]);

            // Commit And Redirect on index with Success Message
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User Status Updated Successfully!');
        } catch (\Throwable $th) {

            // Rollback & Return Error Message
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Edit User
     * @param Integer $user
     * @return Collection $user
     * @author Shani Singh
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $data = File_data::all();
        return view('users.edit')->with([
            'roles' => $roles,
            'user'  => $user,
            'data'  => $data
        ]);
    }

    /**
     * Update User
     * @param Request $request, User $user
     * @return View Users
     * @author Shani Singh
     */
    public function update(Request $request, User $user)
    {
        // Validations
        $request->validate([
            'first_name'    => 'required',
            'last_name'     => 'required',
            'email'         => 'required|unique:users,email,' . $user->id . ',id',
            'mobile_number' => 'required|numeric|digits:10',
            'role_id'       =>  'required|exists:roles,id',
            'status'       =>  'required|numeric|in:0,1',
        ]);

        DB::beginTransaction();
        try {

            // Store Data
            $user_updated = User::whereId($user->id)->update([
                'first_name'    => $request->first_name,
                'last_name'     => $request->last_name,
                'email'         => $request->email,
                'mobile_number' => $request->mobile_number,
                'role_id'       => $request->role_id,
                'status'        => $request->status,
                'distric'        => $request->distric,
            ]);

            // Delete Any Existing Role
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();

            // Assign Role To User
            $user->assignRole($user->role_id);

            // Commit And Redirected To Listing
            DB::commit();
            return redirect()->route('users.index')->with('success', 'User Updated Successfully.');
        } catch (\Throwable $th) {
            // Rollback and return with Error
            DB::rollBack();
            return redirect()->back()->withInput()->with('error', $th->getMessage());
        }
    }

    /**
     * Delete User
     * @param User $user
     * @return Index Users
     * @author Shani Singh
     */
    public function delete(User $user)
    {
        DB::beginTransaction();
        try {
            // Delete User
            User::whereId($user->id)->delete();

            DB::commit();
            return redirect()->route('users.index')->with('success', 'User Deleted Successfully!.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Import Users 
     * @param Null
     * @return View File
     */
    public function importUsers()
    {
        return view('users.import');
    }

    public function uploadUsers(Request $request)
    {
        Excel::import(new UsersImport, $request->file);

        return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
