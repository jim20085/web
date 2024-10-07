<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function store(Request $request)
    {
        //驗證輸入
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
        ]);
        //檢查是否有相同的信箱
        $existingUser = User::where('email',$validatedData['email'])
                            -> first();
        if($existingUser){
            return  response()->json([
                'message' => 'Register error ! This email has been used !',
                'exist' => true
            ],200);
        }else{
            $user = User::create([
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password']
            ]);
            return response() ->json([
                'message' => 'user created successfully !',
                'user' => $user
            ],201);
        }
    }
}

