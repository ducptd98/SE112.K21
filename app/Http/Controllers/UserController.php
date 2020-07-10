<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use Illuminate\Http\Request;
use JWTAuthException;
use Hash;
class UserController extends Controller
{   
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }

    //Register
    public function register(Request $request){
        $data  = new User();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = Hash::make($request->password);
        if($data->save()){
            return response()->json([
                'status'=> 200,
                'message'=> 'User created successfully',
                'data'=>$data
            ]);
        }
        return response()->json([
            'status'=> 500,
            'message'=> 'User created fail',
        ]);
    }

    // Login
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['invalid_email_or_password'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    //Get Info
    public function getUserInfo(Request $request){
        $user = JWTAuth::toUser($request->token);
        if ($user) {
            # code...
            return response()->json(['result' => $user]);
        }
        return response()->json(['failed_to_create_token'], 500);
    }
} 