<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $validate = $request->validate(
            ['name' => 'required',
             'email' => 'required|email|unique:users',
             'password' => 'required',
             'password_confirmation' => 'required|same:password']
        );
        //encrypt password 
        $validate['password'] = bcrypt ($request->password);

        //simpan data user ke tabel users
        $user = User::create($validate);
        if($user){
            $data['success'] = true;
            $data['message'] = 'User berhasil disimpan';
            $data['data'] = $user->name; //nama user
            $data['token'] = $user->createToken('MDPApp')->plainTextToken;
            return response()->json($data, Response::HTTP_CREATED); //201
        }else {
            $data['success'] = false;
            $data['message'] = 'User gagal disimpan';
            return response()->json($data, Response::HTTP_BAD_REQUEST); //400
        }
    }
    public function login(Request $request){
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])){
            //ambil data user
            $user = Auth::user();
            $data['success'] = true;
            $data['message'] = 'login berhasil';
            $data['token'] = $user->createToken('MDPApp') ->plainTextToken;
            $data['data'] = $user;
            return response()->json($data, Response::HTTP_OK);
        }else{
            $data['success'] = false;
            $data['message'] = 'email atau password salah';
            return response()->json($data, Response::HTTP_UNAUTHORIZED);
        }
    }
}
