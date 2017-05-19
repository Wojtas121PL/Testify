<?php

namespace Modules\UserControl\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class UserControlController extends Controller
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
    public function changeEmail(ChangeEmail $request)
    {
        $counter = 0;
        foreach ($request->mail as $id => $item) {
            if($item['emails'] != null){
                User::where('id', '=', $id)->update(['email' => $item['emails']]);
                $counter++;
            }
        }
        if ($counter==0){
            return back()->with('done', 'nothing');
        }
        return back()->with('done', 'yes');
    }
    public function changePassword(ChangePassword $request){
        $counter = 0;
        foreach($request->pwd as $id => $item) {
            if ($item['pwd'] != null) {
                User::where('id', '=', $id)->update(['password' => bcrypt($item['pwd'])]);
                $counter++;
            }
            if ($counter==0){
                return back()->with('done', 'nothing');
            }
        }
        return back()->with('done', 'yes');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
