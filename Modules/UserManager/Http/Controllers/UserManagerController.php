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
        $Groups=Groups::select('id','group_name')->get();
        $UsersGroup = GroupUsers::select('group_id')->where('user_id',$id)->get();
        foreach ($Groups as $group){
            $group->setAttribute('status','noBelong');
            $UsersGroup->each(function ($item) use ($group){
                if($group->id == $item->group_id){
                    $group->setAttribute('status', 'belong');
                }
            });

        }
        return view('usermanager::changeUser', ['user' => $user, 'id' => $id, 'groups' => $Groups]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function change(Request $request, $id)
    {
        global $counterBack;
        $counterBack =0;
        $User = User::where('id', $id)->first();
        if ($request->mail != null) {
            $User->email = $request->mail;
            $counterBack = +1;
        }
        if ($request->pwd != null) {
            $User->password = bcrypt($request->pwd);
            $counterBack = +2;
        }
        $User->save();
        //Save Groups To Database For Once User

        $UserBelongs = GroupUsers::select('*')->where('user_id','=',$id)->get();
        $counterBack = 0;
        foreach ($request->group as $i => $item) {
            if ($item['set'] == 1 && !isset($item['check'])) {
                GroupUsers::where('user_id', $id)->where('group_id', $i)->first()->delete();
            }

            if (isset($item['check'])) {
                if ($item['set'] == 0 && $item['check'] == 'on') {
                    $counter = 0;
                    foreach ($UserBelongs as $user) {
                        $counter = 0;
                        if ($user->group_id == $i) {
                            $counter = 1;
                        }
                    }
                    if ($counter == 0) {
                        $belong = new GroupUsers();
                        $belong->user_id = $id;
                        $belong->group_id = $i;
                        $belong->save();
                    }
                }
            }
        }
        return back()->with('Done', $counterBack);
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
