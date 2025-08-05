<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\register;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexgeneral()
    {
        return view('users/indexgeneral');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/', 'max:30'],
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'string', 'min:6', 'regex:/[A-Z]/', 'regex:/[a-z]/', 'regex:/[0-9]/', 'regex:/[@$!%*?&]/', 'confirmed'],
            'password_confirmation' => ['required']
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede tener más de 30 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras y espacios.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Este formato no es válido.',
            'email.unique' => 'El correo electrónico ya está en uso.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.regex' => 'La contraseña debe contener al menos una letra mayúscula, una letra minúscula, un número y un carácter especial.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        $users = new User();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->role = 'cliente'; // rol por defecto
        $users->save();

        $registers = new Register();
        $registers->name = $request->name;
        $registers->email = $request->email;
        $registers->password = $users->password;
        $registers->save();

        return to_route('indexgeneral')->with('success', '¡Registro completado
        correctamente!');
    }

    public function loguear(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required']
        ], [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Este formato no es válido.',
            'password.required' => 'La contraseña es obligatoria.',
        ]);
        $credenciales = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credenciales)) {
            $users = Auth::user();

            // Verificar el rol del usuario y redirigir a la ruta correspondiente
            if ($users->role === 'admin') {
                return redirect()->route('admin.index')->with('success', '¡Inicio de sesión exitoso!'); // Ruta de admin
            } else if ($users->role === 'client') {
                return redirect()->route('users/indexgeneral')->with('success', '¡Inicio de sesión exitoso!'); // Ruta de cliente
            }
        } else {
            return back()->withErrors(['login' => 'Correo o contraseña incorrectos.'])->withInput();
        }
    }
}
