<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\adivsor_info;
use DB;

class TeacherController extends Controller
{
    private $response=[
        'message'=>null,
        'data'  =>null,
    ];
    public function add_adivisor_info(Request $req)
    {
        $advisor = new adivsor_info();
        $phone=$req->phone;
        $skill=$req->skill;
        $advise=$req->advise;
        $mcacc=$req->mcacc;
        $tech=$req->tech;
        $id=$req->id;
        DB::update(' UPDATE adivsor_infos set phone=?,skill=? ,advise=?,mcacc=?,tech=? where id=?',[
            $phone,$skill,$advise,$mcacc,$tech,$id]);
            return response()->json(['status_code'=>200,'message'=>'success']);
        
    }
    public function show_rating()
    {
        $room = adivsor_info::all();
        $this->response['message'] = 'List Advisor Rating';
        $this->response['data']=$room;
        return response()->json($this->response,200);
    }
}
