<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request)
    {
        //validate incoming request 
        $this->validate($request, [            
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        try {

            $user = new User;            
            $user->email = $request->input('email');
            $plainPassword = $request->input('password');
            $user->password = app('hash')->make($plainPassword);

            $user->save();

            //return successful response
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } catch (\Exception $e) {
            //return error message
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

     /**
     * Get a JWT via given credentials.
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
          //validate incoming request 
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            try{
                $user = new User;            
                $user->email = $request->input('email');
                $plainPassword = $request->input('password');
                $user->password = app('hash')->make($plainPassword);
    
                $user->save();
                if (! $token = Auth::attempt($credentials)) {
                    return response()->json(['message' => 'Unautorized!'], 401);
                }
            } catch (\Exception $e) {
                //return error message
                return response()->json(['message' => 'Error: Unautorized!'], 401);
            }
        }

        return $this->respondWithToken($token);
    }
}
