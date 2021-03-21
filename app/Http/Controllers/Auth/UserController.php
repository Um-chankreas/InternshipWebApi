<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\SchoolModel;
use App\Models\TeacherModel;
use App\Models\StudentModel;
use App\Models\JuryModel;

class UserController extends Controller
{
    private $response =[
        'message'   => null,
        'data'  => null,
    ];
    public function register(Request $req)
    {
        $validator = Validator::make($req->all(),
        [
            'name'  => 'required',
            'email'  => 'required|email',
            'password'  => 'required',
            'type'  => 'required',
        ]);
        if($validator->fails())
        {
            return response()->json(['status_code'=>300,'message'=>'Bad Create']);
        }
        else{
            if($req->input('type')=="student")
            {
                $data = StudentModel::create([
                    'stuName'=>$req->name,
                    'email' =>$req->email,
                    
                ]);
            }
            elseif($req->input('type')=="teacher")
            {
                $data = TeacherModel::create([
                    'teachName'=>$req->name,
                    'email' =>$req->email,
                    
                ]);
            }
            elseif($req->input('type')=="jury")
            {
                $data = JuryModel::create([
                    'juryName'=>$req->name,
                    'email' =>$req->email,
                    
                ]);
            }
            elseif($req->input('type')=="school")
            {
                $data = SchoolModel::create([
                    'schoolName'=>$req->name,
                    'email' =>$req->email,
                    
                ]);
            }
            $data = User::create([
                'name'  =>$req->name,
                'email'  =>$req->email,
                'password'  => Hash::make($req->password),
                'type'  => $req->type,
            ]);
            return response()->json(['status_code'=>200,'message'=>'success']);
        }
    }
    public function login(Request $req)
    {
        $validator = Validator::make($req->all(),[
            'email'=>'required',
            'password'=>'required',
            'type'  =>'required'
        ]);
        if($validator->fails())
        {
            return response()->json(['status_code'=>400,'message'=>'Bad Request']);
        }
        $credentail = request(['email','password']);
        if(!Auth::attempt($credentail))
        {
            return response()->json(['status_code'=>500,'message'=>'Unauthorized']);
        }
        if($req->type=="student")
        {
            $student = StudentModel::where('email',$req->email)->first();
            if($student)
            {
                $user = User::where('email',$req->email)->first();
                $token = $user->createToken($req->token_name)->plainTextToken;
                $this->response['message']="Success";
                $this->response['data']=[
                    'token'=>$token,
                    'status_code'=>200
                ];
                return response()->json(
                    $this->response,
                    
                );
            }
            else{
                return response()->json(['status_code'=>500,'message'=>'Dose not have this email in student record']);
            }
        }
        elseif($req->type=="teacher")
        {
            $teacher = TeacherModel::where('email',$req->email)->first();
            if($teacher)
            {
                $user = User::where('email',$req->email)->first();
                $token = $user->createToken($req->token_name)->plainTextToken;
                $this->response['message']="Success";
                $this->response['data']=[
                    'token'=>$token,
                    'status_code'=>200
                ];
                return response()->json(
                    $this->response,
                    
                );
            }
            else{
                return response()->json(['status_code'=>500,'message'=>'Dose not have this email in table']);
            }
        }
        elseif($req->type=="school")
        {
            $school = SchoolModel::where('email',$req->email)->first();
            if($school)
            {
                $user = User::where('email',$req->email)->first();
                $token = $user->createToken($req->token_name)->plainTextToken;
                $this->response['message']="Success";
                $this->response['data']=[
                    'token'=>$token,
                    'status_code'=>200
                ];
                return response()->json(
                    $this->response,
                    
                );
            }
            else{
                return response()->json(['status_code'=>500,'message'=>'Dose not have this email in School record']);
            }
        }
        elseif($req->type=="jury")
        {
            $jury = JuryModel::where('email',$req->email)->first();
            if($jury)
            {
                $user = User::where('email',$req->email)->first();
                $token = $user->createToken($req->token_name)->plainTextToken;
                $this->response['message']="Success";
                $this->response['data']=[
                    'token'=>$token,
                    'status_code'=>200
                ];
                return response()->json(
                    $this->response,
                    
                );
            }else{
                return response()->json(['status_code'=>500,'message'=>'Dose not have this email in Jury record']);
            }
        }
        
    }
    public function get_user()
    {
        $user = Auth::user();
        $this->response['message'] = 'List of user';
        $this->response['data']=$user;
        return response()->json($this->response,200);
    }
    public function logout()
    {
        $logout = auth()->user()->currentAccessToken()->delete();
        $this->response['message'] = 'delete token';
        return response()->json($this->response,200);
    }
    public function get_student()
    {
        $student=StudentModel::all();
        $this->response['message'] = 'List of user';
        $this->response['data']=$student;
        return response()->json($this->response,200);
    }
}
