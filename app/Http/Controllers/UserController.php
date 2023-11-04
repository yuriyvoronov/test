<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function make_token(Request $request)
    {
        // dd(User::find($request->id));
        $token = User::find($request->id)->createToken('test_token');

        return ['token' => $token->plainTextToken];
    }

}
