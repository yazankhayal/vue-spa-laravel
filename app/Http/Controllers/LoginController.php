<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), $this->ruls());
        if ($validation->fails())
        {
            return response()->json(['errors'=>$validation->errors()]);
        }
        else {
            if (Auth::attempt($request->only('email', 'password'))){
                return response()->json(Auth::user(), 200);
            }
            else{
                return response()->json(['errors'=>'The provided credentials are incorect.']);
            }
        }
    }

    public function ruls(){
        return [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];
    }

    public function logout()
    {
        Auth::logout();
    }
}
