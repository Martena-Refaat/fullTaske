<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\student;
use Illuminate\Http\Request;

class studentController extends Controller
{

    public function index()
    {
        if(auth()->check()){

        $students =  student::get();

        return view('students.index', ['data' => $students]);
    }else{
        return redirect(url('Login'));
     }
    }



    public function create()
    {

        return view('students.create');
    }


    public function store(Request $request)
    {

        $data =  $this->validate($request, [
            'name'     => "required",
            'email'    => "required|email",
            'password' => "required|min:6",
        ]);
        $data['password']  = bcrypt($data['password']);

        $op =  student :: create($data);

        if ($op) {
            $message = "Student Created Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Student Not Created";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Students/Create'));

}

public function edit($id)
{

    $student  = student::find($id);

    return view('students.edit', ['data' => $student]);
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



        $op = student::where('id', $id)->update($data);

        if ($op) {
            $message = "Student Updated Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Student Not Updated";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Students'));
    }





public function remove(Request $request)
    {

        $student = student::find($request->id);

        $op =   student::where('id', $request->id)->delete();   // delete from users where id = $id

        if ($op) {



            $message = "Student Removed Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "Student Not Removed";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Students'));
    }
}
