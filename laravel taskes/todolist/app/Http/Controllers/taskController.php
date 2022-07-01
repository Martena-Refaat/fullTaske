<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class taskController extends Controller
{


    function __construct()
    {
          $this->middleware('deleteTask', ['exept'=> ['index','create','store','show','edit','update']]);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {





        $data = DB::table('taskes')
        ->join('users', 'taskes.user_id', '=', 'users.id')
        ->select('taskes.*', 'users.name')
        ->get();
        return view('taskes.index', ['title' => "List taskes.", 'data' => $data]);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */





    public function create()
    {
        return view('taskes.create');
    }






    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */







    public function store(Request $request)
    {
        $data =   $this->validate($request, [
            "title"    => "required | min:10 | max : 150",
            "content"  => "required|min:30 | max:15000",
            "image"    => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "startDate"     => "required|date",
            "endDate"     => "required|date",

        ]);

        $imageName = time() . uniqid() . '.' . $request->image->extension();

        $data['startDate'] = strtotime($data['startDate']);
        $data['endDate'] = strtotime($data['endDate']);


        $request->image->move(public_path('images/taskes'), $imageName);

        $data['image'] = $imageName;

        $data['user_id'] = auth()->user()->id;

        $op = DB::table('taskes')->insert($data);
        if ($op) {
            $message = "task Created Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "task Not Created";
            session()->flash('Message-error', $message);
        }
        return redirect(url('Taskes'));

    }






    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */







    public function show($id)
    {

        $data = DB::table('taskes')
        ->join('users', 'taskes.user_id', '=', 'users.id')
        ->select('taskes.*', 'users.name')
        ->where('taskes.id', $id)

        ->get();
        return view('taskes.details', ['title' => "Taskes dEtails.", 'data' => $data]);


    }






    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */





    public function edit($id)
    {


    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */




    public function update(Request $request, $id)
    {

        $data =   $this->validate($request, [
            "title"    => "required | min:10 | max : 150",
            "content"  => "required|min:30 | max:15000",
            "image"    => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
            "startDate"     => "required|date",
            "endDate"     => "required|date",

             ]);

          $op = DB::table('taskes')->where('id', $id)->update($data);


          if ($op) {
        $imageName = time() . uniqid() . '.' . $request->image->extension();

        $data['startDate'] = strtotime($data['startDate']);
        $data['endDate'] = strtotime($data['endDate']);


        $request->image->move(public_path('images/taskes'), $imageName);

            $data['image'] = $imageName;
              $message = "task Updated Successfully";
              session()->flash('Message-success', $message);
          } else {
              $message = "task Not Updated";
              session()->flash('Message-error', $message);
          }




    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */





    public function destroy($id)
    {


        $data = DB::table('taskes')->find($id);
        $op = DB::table('taskes')->where('id', $id)->delete();

        if ($op) {

            unlink(public_path('images/taskes/' . $data->image));

            $message = "task Deleted Successfully";
            session()->flash('Message-success', $message);
        } else {
            $message = "task Not Deleted";
            session()->flash('Message-error', $message);
        }

        return redirect(url('Taskes'));
    }
    }

