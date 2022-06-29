<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class authStudentController extends Controller
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
            return redirect(url('Students'));
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
