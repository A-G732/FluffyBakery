<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexgeneral(){
        return view('users/index');
    }

    public function login(){
        return view('modules.auth.login');
    }

    public function register(){
        return view('modules.auth.register');
    }

    public function registrar(Request $request){
        $request->validate([
        'name' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/','max:30'],
        'email' => 'required|email|unique:users,email',
        'password' => ['required', 'string', 'min:6','regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/', 'confirmed'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede tener más de 30 caracteres.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Este formato no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);
        
        $item = new User();
        $item->name = $request->name;
        $item->email = $request->email;
        $item->password = Hash::make($request->password);
        $item->save();
        return to_route('login')->with('registro_exitoso', '¡Registro completado
        correctamente!');
    }

    public function loguear(Request $request){
        $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:6'
        ]);
        $credenciales = [
        'email' => $request->email,
        'password' => $request->password
        ];

        if (Auth::attempt($credenciales)) {
            return to_route('productos.index');
        } else{
            return to_route('login');
        }
    }

}
