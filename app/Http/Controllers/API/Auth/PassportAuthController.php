<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\Token;


class PassportAuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request,[
            'name' =>'required',
            'email' =>'required|email',
            'password' => 'required|min:8',
            // 'password' => '<PASSWORD>',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            // 'password' => bcrypt($request->password),
            // 'password' => <PASSWORD>($request->password),
        ]);
        $token=$user->createToken('$20@24TT--$zone')->accessToken;
        return response()->json([
            'token' => $token,
            // 'user' => $user,
        ],200);
    }

    public function login(Request $request){
        $data=["email"=>$request->email,"password"=>$request->password];
        if(auth()->attempt($data)){
            $user = auth()->user();
            $token=$user->createToken('$20@24TT--$zone')->accessToken;
            return response()->json(['token' => $token,'data'=>$data,'user'=>$user],200);
        }else{
            return response()->json([
              'message' => 'Invalid Credentials','data'=>$data
            ],401);
        }
    }
    public function userInfo(){
        $user = auth()->user();
        return response()->json([
            'user' => $user,
        ],200);
    }
    // public function logout(Request $request)
    // {
        
    //     $accessToken = Auth::user()->tokens();
    //     $tokenRepository = new TokenRepository();
    //     $tokenRepository->revokeAccessToken($accessToken);
    //     return response()->json(['message' => 'Successfully logged out']);
    // }
    public function logout(Request $request)
{
    $token = $request->user()->token();
    $token->revoke();

    return response()->json([
        'message' => 'Successfully logged out',
    ], 200);
}

}
