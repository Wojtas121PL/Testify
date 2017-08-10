<?php

namespace Modules\UserManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\User\Entities\User;
use Modules\Exam\Entities\Groups;
use Modules\Exam\Entities\GroupUsers;

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
    public function store(Request $request)
    {
        $arrayRole = array("Administrator" => 1, "Edytor" => 2, "Użytkownik" => 3);
        $Users = User::select('email')->get();
        global $counter;
        foreach ($Users as $user){
            if ($user->email == $request->email){
                $counter=1;
            }
        }
        if ($counter==1){
            unset($counter);
            return back()->with('done', 'existEmail');
        }
        else {
            unset($counter);
            $user = new User();
            $user->name = $request->nameUser;
            $user->email = $request->email;
            $user->password = bcrypt($request->pwd);
            $user->role = $arrayRole[$request->role];
            $user->save();
            return back()->with('done', 'yes');
        }
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
    public function getListUser()
    {
        $users = User::select('id', 'name', 'email', 'role', 'remember_token', 'created_at', 'updated_at')->get();
        $groupsOfUsers = GroupUsers::select('*')
            ->join('groups','group_users.group_id','=','groups.id')
            ->get();
        return view('usermanager::index', ['users' => $users, 'groupsOfUsers' => $groupsOfUsers]);
    }

    public function goToUser($id)
    {
        $user = User::select('*')->where('id', $id)->get();
        $groupOfUser = GroupUsers::select('*')->where('user_id',$id)->get();
        return view('usermanager::changeUser', ['user' => $user, 'id' => $id, 'groups' => $groupOfUser]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function change(Request $request, $id)
    {
        $counter = 0;
        $User = User::where('id', $id)->first();
        if ($request->mail != null) {
            $User->email = $request->mail;
            $counter = +1;
        }
        if ($request->pwd != null) {
            $User->password = bcrypt($request->pwd);
            $counter = +2;
        }
        $User->save();
        return back()->with('Done', $counter);
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $User = User::where('id', $id)->first();
        if ($User->role != 0) {
            if ($User->role == 1) {
                return back()->with('root', 'try');
            }
            else {
                $User->role = 0;
                $User->save();
            }
            return back()->with('disabled', 'yes');
        }
        else {
            return back()->with('was', 'yes');
        }
    }

    public function delete($id)
    {
        $User = User::where('id',$id)->first();
            $User->delete();
            return redirect('/usermanager/')->with('delete', $User->name);
    }
}
