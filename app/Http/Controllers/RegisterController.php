<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index () 
    {
        return view('auth.register');
    }

    public function store (Request $request) 
    {
       // dd('Post...');
       // dd($request); se imprimen los valores enviados en form
       // dd($request->get('username)); campo especifico

       //modificar el request pero solo de ultima instancia
       $request->request->add(['username' => Str::slug($request->username)]);

       $this->validate($request, [
        'name' => 'required|min:5',
        'username' => 'required|unique:users|min:3|max:20',
        'email' => 'required|unique:users|email|max:60',
        'password' => 'required|confirmed|min:6'
       ]);
//equivalente a un insert 
       User::create([
        'name' =>$request->name,
        'username' =>$request->username,
        'email' =>$request->email,
        'password' =>Hash::make($request->password)
       ]);

       //autenticar usuario en login
       auth()->attempt([
        'email' => $request->email,
        'password' => $request->password,
       ]);

       //otra forma de autenticar
       auth()->attempt($request->only('email','password'));

       //redireccionar

       return redirect()->route('posts.index',auth()->user()->username);
       
    }

}