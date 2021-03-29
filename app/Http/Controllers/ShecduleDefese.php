<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Scheduale;
use App\Models\StudentModel;
use App\Models\studentdetail;
use DB;
class ShecduleDefese extends Controller
{
    private $response=[
        'message'=>null,
        'data'  =>null,
    ];
    public function create(Request $req)
    {
        $student = StudentModel::where('email',$req->email)->first();
        $validator = Validator::make($req->all(),
        [
            'studentName'  => 'required',
            'room'  => 'required',
            'generate'  => 'required',
            // 'defensedate'  => 'required',
            // 'fromtime'  => 'required',
            // 'totime'  => 'required',
            'email' =>'required',
            'topic'  => 'required',
            'company'  => 'required',
            'advisor'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['status_code'=>500,'message'=>'Bad Create']);
        }
        elseif(!$student)
        {
            return response()->json(['status_code'=>500,'message'=>'Student don not have this email']);
        }
        
        else{
            
            $data = Scheduale::create([
                'studentName'=>$req->studentName,
                'room' =>$req->room,
                'generate'=>$req->generate,
                'defensedate'=>$req->defensedate,
                'fromtime' =>$req->fromtime,
                'totime'=>$req->totime,
                'topic'=>$req->topic,
                'email'=>$req->email,
                'company' =>$req->company,
                'advisor'=>$req->advisor,
                'studentid'=>$student->id
                
            ]);
            $room = $data->room;
            $studentid=$student->id;
            $generate = $data->generate;
            $defensedate = $data->defensedate;
            $fromtime = $data->fromtime;
            $totime = $data->totime;
            $topic = $data->topic;
            $company = $data->company;
            $advisor = $data->advisor;
            DB::update(' UPDATE studentdetails set room=?,generate=? ,defensedate=?,fromtime=?,totime=?,topic=?,company=?,advisor=? where studentid=?',[$room,$generate,
            $defensedate,$fromtime,$totime,$topic,$company,$advisor,$studentid]);
            return response()->json(['status_code'=>200,'message'=>'success']);
        }
    }
    public function show()
    {
        $roomm = DB::table('scheduales')
                 ->select('room', DB::raw('room'))
                 ->groupBy('room')
                 ->get();
        $room = Scheduale::all()->groupBy('room');
        $this->response['message'] = 'List room of schedule';
        $this->response['data']=$room;
        // $this->response['data']=$room;
        return response()->json($this->response,200);
    }
    public function listCaditate()
    {
        $student = studentdetail::all();
        $this->response['message'] = 'List Student';
        $this->response['data']=$student;
        return response()->json($this->response,200);
    }
}
