<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Interest;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class AuthController extends Controller
{
    public $successStatus = 200;

    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $data = $request->all();

        $input['name'] = $data['name'];
        $input['email'] = $data['email'] ;
        $input['student_id'] = $data['student_id'] ;
        $input['role'] = $data['role'] ;
        $input['image_path'] = $data['image_path'];
        $input['disiplin'] = $data['disiplin'];
        $input['password'] = bcrypt($data['password']);
        $user = User::create($input);
        
        foreach ($data['interest'] as $key => $value) {
            $interest['user_id'] = $user['id'];
            $interest['interest'] = $value;
            Interest::create($interest);
        }
        $success['token'] =  $user->createToken('AppName')->accessToken;
        return response()->json([
            'success' => true,
            'data' => $success
        ], $this->successStatus);
    }


    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] =  $user->createToken('AppName')->accessToken;
            return response()->json([
                'success' => true,
                'data' => $success
            ], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    public function getUser()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function updateUser(Request $request, $id)
    {   
        $input = $request->all();
        $user = User::find($id);
        $user->update($input);
        return response()->json([
            'success' => true,
            'message' => 'success update'
        ], $this->successStatus);

    }
}
