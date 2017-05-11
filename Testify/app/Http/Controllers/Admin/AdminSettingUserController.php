<?php

namespace Testify\Http\Controllers\Admin;

use Testify\Http\Controllers\Controller;
use Testify\Http\Requests\Admin;
use Testify\User;

class AdminSettingUserController extends Controller
{
    public function changePassword(Admin\ChangePassword $request){
        User::where('id','=',$request->id)->update(['password' => Hash::make($request->password)]);
    }
    public function createUser(Admin\CreateUser $request)
    {
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 3,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }
        public function deleteUser(Admin\DeleteUser $request)
        {
            User::where('id','=',$request->id)->delete();
        }
    public function changeEmail(Admin\ChangeEmail $request){
        User::where('id','=',$request->id)->update(['email' => $request->email]);
    }
    }
