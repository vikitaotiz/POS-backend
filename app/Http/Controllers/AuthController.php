<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\RegisterResource;
use App\Http\Resources\LoginResource;
use App\Http\Resources\PinLoginResource;
use Auth;

class AuthController extends Controller
{
    public function pin_login(Request $request){

        $user = User::where('pin', $request->pin)->first();

        if($user) {

            if(!$token = auth()->attempt(['email' => $user->email, 'password' => $user->pwd_clr])){
            return response()->json(['error' => 'Unauthorized'], 401);
            }

            return (new PinLoginResource($user))->additional([
                'token' => $token
            ]); 
        }

        return response()->json(['error' => 'user with this pin does not exist']);

    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'pwd_clr' => $request->password
        ]);

        if(!$token = auth()->attempt($request->only(['email', 'password']))){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return (new RegisterResource($request->user()))->additional([
            'token' => $token
        ]);

    }

    public function login(LoginRequest $request)
    {
        if(!$token = auth()->attempt($request->only(['email', 'password']))){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return (new loginResource($request->user()))->additional([
            'token' => $token
        ]);

    }

    public function user(Request $request)
    {
        return new LoginResource($request->user());
    }

    public function logout()
    {
        auth()->logout();
    }
}
