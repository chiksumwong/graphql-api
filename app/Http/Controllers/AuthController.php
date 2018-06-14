<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\user;
use App\Http\Requests\RegisterFormRequest;
use JWTAuth;
use Auth;

class AuthController extends Controller
{
    public function register(RegisterFormRequest $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->save();
        return response([
            'status' => 'success',
            'data' => $user
           ], 200);
     }

     public function login(Request $request)
     {
         $credentials = $request->only('email', 'password');
         if ( ! $token = JWTAuth::attempt($credentials)) {
                 return response([
                     'status' => 'error',
                     'error' => 'invalid.credentials',
                     'msg' => 'Invalid Credentials.'
                 ], 400);
         }

         return response(['status' => 'success'])
             ->header('Authorization', $token);
     }
     
     public function logout()
     {
         JWTAuth::invalidate();
         return response([
             'status' => 'success',
             'msg' => 'Logged out Successfully.'
         ], 200);
     }

    /*  
    *   其中 user() 方法用於獲取當前登錄用戶數據
    *   而 refresh() 方法用於檢查當前登錄用戶 token 是否仍然有效。，
    */  
     public function user()
     {
         $user = User::find(Auth::user()->id);
         return response([
                 'status' => 'success',
                 'data' => $user
             ]);
     }
     public function refresh()
     {
         return response([
                 'status' => 'success'
             ]);
     }
}
