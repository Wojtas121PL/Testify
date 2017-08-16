<?php

namespace Modules\GroupManager\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\GroupManager\Http\Requests\AddGroupAndUserToGroup;
use Modules\GroupManager\Http\Requests\SaveGroup;
use Modules\GroupManager\Http\Requests\UpdateGroup;
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
        $UsersGroup = GroupUsers::select('name','group_name','user_id','role')
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
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $group=Groups::select('group_name')->where('id',$id)->get();
        $Users=User::select('id','name')->where('role',3)->get();
        $UsersGroup = GroupUsers::select('user_id','id')->where('group_id',$id)->get();
        foreach ($Users as $user){
            $user->setAttribute('status','noBelong');
            $UsersGroup->each(function ($item) use ($user){
                if($user->id == $item->user_id){
                    $user->setAttribute('status', 'belong');
                }
            });

        }
        return view('groupmanager::edit',['group' => $group, 'id'=>$id,'Users'=>$Users]);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateGroup $request,$id)
    {
        $groups = Groups::where('id', $id)->first();

        $groups->group_name = $request->new_name;

        $groups->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        Groups::where("id", $id)->first()->delete();
        return back()->with('done','delete');
    }
    /**
    **My authors method
     */
    public function addGroupView(){
        $Users = User::select('name','role','id')->get();
        return view('groupmanager::addGroup',['Users' => $Users]);
    }

    public function saveToGroup(SaveGroup $request){
        $UserBelongs = GroupUsers::select('*')->where('group_id','=',$request->groupName)->get();
        $counterBack = 0;
        foreach ($request->user as $i => $item) {
            if ($item['set'] == 1 && !isset($item['check'])) {
                GroupUsers::where('user_id', $i)->where('group_id', $request->groupName)->first()->delete();
            }

            if (isset($item['check'])) {
                if ($item['set'] == 0 && $item['check'] == 'on') {
                    $counter = 0;
                    foreach ($UserBelongs as $user) {
                        $counter = 0;
                        if ($user->user_id == $i) {
                            $counter = 1;
                        }
                    }
                    if ($counter == 0) {
                        $belong = new GroupUsers();
                        $belong->user_id = $i;
                        $belong->group_id = $request->groupName;
                        $belong->save();
                        $counterBack++;
                    }
                }
            }
        }
        return back()->with('done','yes');
    }
}
