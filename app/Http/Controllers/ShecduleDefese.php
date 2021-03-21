<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Scheduale;

class ShecduleDefese extends Controller
{
    private $response=[
        'message'=>null,
        'data'  =>null,
    ];
    public function create(Request $req)
    {
        $validator = Validator::make($req->all(),
        [
            'studentName'  => 'required',
            'room'  => 'required',
            'generate'  => 'required',
            // 'defensedate'  => 'required',
            // 'fromtime'  => 'required',
            // 'totime'  => 'required',
            'topic'  => 'required',
            'company'  => 'required',
            'advisor'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['status_code'=>500,'message'=>'Bad Create']);
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
                'company' =>$req->company,
                'advisor'=>$req->advisor,
                
            ]);
            return response()->json(['status_code'=>200,'message'=>'success']);
        }
    }
}
