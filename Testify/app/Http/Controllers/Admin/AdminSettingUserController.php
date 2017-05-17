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
            return redirect('/admin/setting/deleteUser')->with('done','yes');
        }
        else{
            return redirect('/admin/setting/deleteUser')->with('done','root');
        }


    }

    public function changeEmail(Admin\ChangeEmail $request)
    {
        $counter = 0;
        foreach ($request->mail as $id => $item) {
            if($item['emails'] != null){
                User::where('id', '=', $id)->update(['email' => $item['emails']]);
                $counter++;
            }
        }
        if ($counter==0){
            return redirect('/admin/setting/changeEmail')->with('done', 'nothing');
        }
        return redirect('/admin/setting/changeEmail')->with('done', 'yes');
    }

    public function changePassword(Admin\ChangePassword $request){
        $counter = 0;
        foreach($request->pwd as $id => $item) {
            if ($item['pwd'] != null) {
                User::where('id', '=', $id)->update(['password' => bcrypt($item['pwd'])]);
                $counter++;
            }
            if ($counter==0){
                return redirect('/admin/setting/changePwd')->with('done', 'nothing');
            }
        }
        return redirect('/admin/setting/changePwd')->with('done', 'yes');
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
    public function getListUser(){
        $users = User::select('id', 'name', 'email', 'role', 'remember_token', 'created_at', 'updated_at')->get();
        return view('admin.settingUser.settings',['users' => $users]);
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
