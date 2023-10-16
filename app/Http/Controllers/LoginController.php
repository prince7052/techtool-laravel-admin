<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\File_data;
use App\Models\User;


use Hash;
class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function user_dashboard()
    {
      $dist = auth()->user()->distric;
      $count1 = File_data::where('Dest', $dist)->where('status', 1)->count();
      $count2 = File_data::where('Dest', $dist)->where('status', 0)->count();
      return view('user.home', ['count1' => $count1,'count2' => $count2]); 
      
    }
  
    public function admin_dashboard()
    {
      $count1 = File_data::count();
      $count2 = User::count();
      return view('admin.home', ['count1' => $count1,'count2' => $count2]); 
    }

    public function check(Request $request)
    {
     $credentials = $request->validate([
     'email' => ['required', 'email'],
     'password' => ['required'],
        ]);
        
        if (Auth::attempt($credentials)) 
        {
           // return view('home');
          /* if(Auth::user()->role_id == 1){
            return $this->admin_dashboard();
          }
          else{
            return $this->user_dashboard();
          }*/

          return redirect()->route('home');  

         }
         // return "<h2>Username or Password Invalid!</h2>";  
          return redirect()->route('login')->with('error', 'Username or Password Invalid!');
       }
}