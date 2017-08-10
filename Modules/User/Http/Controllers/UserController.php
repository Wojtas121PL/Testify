<?php

namespace Modules\User\Http\Controllers;

use function Couchbase\basicDecoderV1;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
//use Modules\User\Http\Requests\CreateUser;
use Modules\Exam\Entities;
use Illuminate\Support\Facades\Auth;

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
        $endExam = Entities\Result::select('exam_id')->where('user_id', '=', Auth::id())->groupby('exam_id')->get();
        $expireTime = Entities\Expire::select('expireTime as time')->where('exam_id','=',$id)->where('user_id','=',Auth::id())->get();
        foreach ($endExam as $item) {
            if ($item['exam_id'] == $id) {
                return back()->with('examDone', 'yes');
            }
        }
        if (count($expireTime) != 0) {
            if ((strtotime($expireTime[0]->time)) < time()) {
                return back()->with('examExpire','yes');
            }
        }
        return view('user::exam', ['examContent' => $examContent]);
    }

    public function examList()
    {
        $exams = Entities\Exam::all();

        $endExam = Entities\Result::select('exam_id')->where('user_id', '=', Auth::id())->groupby('exam_id')->get();
        $expireTime = Entities\Expire::where('user_id','=',Auth::id())->get();
        $belongExam = Entities\ExamUser::select('exam_id')->get();
        $groupsUser = Entities\GroupUsers::select('group_id')->where('user_id',Auth::id())->get();
        //This checks if exam is expired or finished.
        //If true, it appends atribute 'status' for each exam
        foreach($exams as $exam){
            $exam->setAttribute('status', '');
            $belongExam->each(function ($item, $key) use ($exam, $groupsUser){
                if($exam->id == $item->exam_id){
                    $exam->setAttribute('statusBelong', 'yes');
                }
                foreach ($groupsUser as $groupUser){
                    if($groupUser->group_id == $item->group_id){
                        $exam->setAttribute('statusBelong', 'yes');
                    }
                }
            });
            $endExam->each(function ($item, $key) use ($exam){
                if($exam->id == $item->exam_id){
                    $exam->setAttribute('status', 'finished');
                }
            });
            $expireTime->each(function ($item, $key) use ($exam){
                if($exam->id == $item->exam_id){
                    if ((strtotime($item->expireTime)) < time()) {
                        $exam->setAttribute('status', 'expired');
                    }
                }
            });
        }
        return view('user::list', ['exams' => $exams]);
    }

    public function examProgressive($id, $question)
    {
        $examContent = Entities\Exam::where('id', $id)->first()->questions[$question];
        $endExam = Entities\Result::select('exam_id')->where('user_id', '=', Auth::id())->groupby('exam_id')->get();
        $expireTime = Entities\Expire::select('expireTime as time')->where('exam_id','=',$id)->where('user_id','=',Auth::id())->get();
        foreach ($endExam as $item) {
            if ($item['exam_id'] == $id) {
                return back()->with('examDone', 'yes');
            }
        }
        if (count($expireTime) != 0) {
            if ((strtotime($expireTime[0]->time)) < time()) {
                return back()->with('examExpire','yes');
            }
        }
        return view('user::examProgressive', ['examContent' => $examContent]);
    }
}
