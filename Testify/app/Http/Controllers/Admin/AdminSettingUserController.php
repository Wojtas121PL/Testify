<?php

namespace Testify\Http\Controllers\Admin;
use Testify\Http\Controllers\Controller;
use Testify\Http\Requests\Admin;
use Testify\User;

class AdminSettingUserController extends Controller
{
    public function deleteUser($id)
    {
        if($id != 1) {
            User::find($id)->delete();
        }
        return redirect('/admin/setting/changePwd')->with('done','yes');

    }

    public function changeEmail(Admin\ChangeEmail $request){
        User::where('id','=',$request->id)->update(['email' => $request->userEmail]);
        return redirect('/admin/setting/changeEmail')->with('done','yes');
    }

    public function changePassword(Admin\ChangePassword $request){
        User::where('id','=',$request->id)->update(['password' => bcrypt($request->pwd)]);
        return redirect('/admin/setting/changePwd')->with('done','yes');
    }

    public function createUser(Admin\CreateUser $request)
    {
        $arrayRole=array("Admin" => 1,"Editor"=>2,"User"=>3);
        $user= new User();
        $user->name = $request->nameUser;
        $user->email = $request->email;
        $user->password = bcrypt($request->pwd);
        $user->role = $arrayRole[$request->role];
        $user->save();
        return redirect('/admin/setting/userAdd')->with('done','yes');
    }

    public function getUserListToDelete(){
        $users = User::select('id','name','email','created_at')->get();
        return view('admin.settingUser.deleteUser',['userList' => $users]);
    }
    public function getUserListToChangeEmail(){
        $users = User::select('id','name','email','created_at')->get();
        return view('admin.settingUser.editEmailUser',['userList' => $users]);
    }
    public function getUserListToChangePwd(){
        $users = User::select('id','name','email','created_at')->get();
        return view('admin.settingUser.editPwdUser',['userList' => $users]);
    }

    }
