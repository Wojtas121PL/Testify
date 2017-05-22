<?php

namespace Modules\UserManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\UserManager\Http\Requests\CreateUser;
use Testify\User;
use \Modules\UserManager\Http\Requests;

class UserManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('usermanager::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('usermanager::settingUser');
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
        return view('usermanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function getListUser(){
        $users = User::select('id', 'name', 'email', 'role', 'remember_token', 'created_at', 'updated_at')->get();
        return view('usermanager::index',['users' => $users]);
    }
    public function getUserListToDelete(){
        $users = User::select('id','name','email','created_at')->get();
        return view('usermanager::settingUser.deleteUser',['userList' => $users]);
    }
    public function getUserListToChangeEmail(){
        $users = User::select('id','name','email','created_at')->get();
        return view('usermanager::settingUser.editEmailUser',['userList' => $users]);
    }
    public function getUserListToChangePwd(){
        $users = User::select('id','name','email','created_at')->get();
        return view('usermanager::settingUser.editPwdUser',['userList' => $users]);
    }
    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function changeEmail(Requests\ChangeEmail $request)
    {
        $counter = 0;
        foreach ($request->mail as $id => $item) {
            if ($item['emails'] != null) {
                User::where('id', '=', $id)->update(['email' => $item['emails']]);
                $counter++;
            }
        }
            if ($counter == 0) {
                return back()->with('done', 'nothing');
            }
            else {
                return back()->with('done', 'yes');
            }
}
    public function changePassword(Requests\ChangePassword $request){
        $counter = 0;
        foreach($request->pwd as $id => $item) {
            if ($item['pwd'] != null) {
                User::where('id', '=', $id)->update(['password' => bcrypt($item['pwd'])]);
                $counter++;
            }
        }
        if ($counter == 0) {
            return back()->with('done', 'nothing');
        }
        else {
            return back()->with('done', 'yes');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        if($id != 1) {
            User::find($id)->delete();
            return back()->with('done','yes');
        }
        else{
            return back()->with('done','root');
        }
    }
}
