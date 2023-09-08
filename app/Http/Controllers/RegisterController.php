<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register'); 
    }

    public function user_dashboard()
    {
      return view('user.home');
    }
  
    public function admin_dashboard()
    {
      return view('admin.home');
    }

    public function store(Request $request)
    {
       $input = $request->all();
       User::create([
        'first_name' => $input['name'],
        'email' => $input['email'],
        'password' => Hash::make($input['password'])
      ]);

      $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
           ]);

           if (Auth::attempt($credentials)) 
           {
           //return view('user.home');
           return redirect()->route('home');  
           }
     /* if(Auth::user()->role_id == 1){
        return $this->admin_dashboard();
      }
      else{
        return $this->user_dashboard(); 
      }*/
    }
}