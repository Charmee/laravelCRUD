<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use App\Models\Products;
use Illuminate\Support\Facades\Auth;


class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
       
    //validates the login data and submits the data
    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
    
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }
   
        return redirect("login")->withSuccess('Login details are not valid');
    }
 
 
 
    public function registration()
    {
        return view('auth.register');
    }
       
    //validates the registration details and submit the data
    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'username' =>'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone' => 'required|min:10'
        ]);
            
        $data = $request->all();
        $check = $this->create($data);
          
        return redirect("dashboard")->withSuccess('have signed-in');
    }
 
    //stores the data of the  registration
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'phone' => $data['phone'],
      ]);
    }    
     
    //opens the dashboard page
    public function dashboard()
    {
        if(Auth::check()){
            $products = Products::where("userid",auth()->user()->id)->paginate(5);
            $netamount = Products::where("userid",auth()->user()->id)->get()->sum("amount");
            return view('auth.dashboard',compact('products','netamount'));
        }
   
        return redirect("login")->withSuccess('are not allowed to access');
    }

    //logout page
    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
