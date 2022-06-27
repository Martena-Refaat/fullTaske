<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    //


    public function create()
    {

        return   view('users.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required|string',
            'content'    => 'required|min:50',
            'image' => 'required|file'
        ]);


        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'), $imageName);
        $inputs=$request->except(['_token']);

          return view('users.Data')->with('inputs'  , $inputs );






    }







}
