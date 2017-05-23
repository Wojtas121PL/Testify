<?php

namespace Modules\User\Http\Controllers;

use function Couchbase\basicDecoderV1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\CreateUser;
use Modules\Exam\Entities;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('user::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateUser $request)
    {
        $arrayRole=array("Admin" => 1,"Editor"=>2,"User"=>3);
        $user= new User();
        $user->name = $request->nameUser;
        $user->email = $request->email;
        $user->password = bcrypt($request->pwd);
        $user->role = $arrayRole[$request->role];
        $user->save();
        return back()->with('done','yes');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request){

    }
    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }

    public function exam($id)
    {
        $examContent = Entities\Exam::where('id', $id)->first();

        return view('user::exam', ['examContent'=>$examContent]);
    }

    public function examList()
    {
        $exams = Entities\Exam::all();

        return view('user::list', ['exams' => $exams]);
    }
}
