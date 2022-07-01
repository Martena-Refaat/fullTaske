<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authcontroller extends Controller
{
    public function login()
     {
        return view('login');
     }


     public function doLogin(Request $request)
     {

        $data = $this->validate($request,[
            "email"    => "required|email",
            "password" => "required|min:6"
        ]);




         if(auth()->attempt($data)){
            return redirect(url('Taskes'));
         }else{
            session()->flash('Message-error', "Invalid Credentials");
             return back();
         }

     }



     public function Logout(){
            auth()->logout();
            return redirect(url('Login'));
     }
}
