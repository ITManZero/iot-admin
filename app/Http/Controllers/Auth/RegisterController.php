<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $user =User::create([
            'name'=>$request->name ,
            'email'=>$request->email ,
            'password'=>Hash::make($request->password),
        ]);
        return response()->json(['massage'=>'register has been done successfully']);
    }
}
