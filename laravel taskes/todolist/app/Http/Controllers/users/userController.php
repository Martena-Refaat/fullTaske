<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\usersmodel;

use Illuminate\Http\Request;

class userController extends Controller
{


    public function index()
    {

        $users =  usersmodel::get();

        return view('users.index', ['data' => $users]);

    }




    public function create()
    {

        return view('users.create');
    }


    public function store(Request $request)
    {

        $data =  $this->validate($request, [
            'name'     => "required",
            'email'    => "required|email",
            'password' => "required|min:6",
        ]);
        $data['password']  = bcrypt($data['password']);

        $op =  usersmodel :: create($data);

        if ($op) {
            $message = "user Created Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "user Not Created";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Users/Create'));

}

public function edit($id)
{

    $users  = usersmodel::find($id);

    return view('users.edit', ['data' => $users]);
}


public function update(Request $request, $id)
    {

        $data =  $this->validate($request, [
            'name'     => "required",
            'email'    => "required|email",
            'password' => 'nullable|min:6',
        ]);


        if ($request->has('changePassword')) {

            $data['password']  = bcrypt($request->password);
        } else {
            unset($data['password']);
        }



        $op = usersmodel::where('id', $id)->update($data);

        if ($op) {
            $message = "user Updated Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "user Not Updated";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Users'));
    }





public function remove(Request $request)
    {
        $users = usersmodel::find($request->id);

        $op =   usersmodel::where('id', $request->id)->delete();

        if ($op) {



            $message = "user Removed Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "user Not Removed";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Users'));
    }

}
