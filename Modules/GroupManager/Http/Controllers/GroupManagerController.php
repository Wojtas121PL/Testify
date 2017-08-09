<?php

namespace Modules\GroupManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GroupManager\Http\Requests\AddGroupAndUserToGroup;
use Modules\User\Entities\User;
use Modules\Exam\Entities\Groups;
use Modules\Exam\Entities\GroupUsers;
class GroupManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $UsersGroup = GroupUsers::select('name','group_name','user_id')
            ->join('groups','group_users.group_id','=','groups.id')
            ->join('users','group_users.user_id','=','users.id')
            ->get();
        $Groups = Groups::select('id','group_name')->get();
        return view('groupmanager::index',['UsersGroup' => $UsersGroup, 'Groups'=>$Groups]);
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(AddGroupAndUserToGroup $request)
    {
        $existGroup = Groups::select('group_name')->get();
        global $counter;
        foreach ($existGroup as $item){
            if ($item->group_name == $request->nameGroup){
                $counter++;
            }
        }
        if ($counter == 0) {
            $groups = new Groups();
            $groups->group_name = $request->nameGroup;
            $groups->save();
            foreach ($request->user as $i => $item) {
                $groupUser = new GroupUsers();
                $groupUser->user_id = $i;
                $groupUser->group_id = $groups->id;
                $groupUser->save();
            }
        }
        else{
            return back()->with('done','existGroupName');
        }
        return back()->with('done','yes');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('groupmanager::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('groupmanager::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
    /**
    **My authors method
     */
    public function addGroup(){
        $Users = User::select('name','id')->get();
        return view('groupmanager::addGroup',['Users' => $Users]);
    }
}
