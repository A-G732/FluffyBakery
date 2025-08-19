@extends('layouts.app') {{-- Usa tu layout principal --}}

@section('content')
<div class="container mx-auto mt-10">
    {{-- Alerta principal --}}
    @if (session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-6">
        <strong class="font-bold">¡Verifica tu correo!</strong>
        <span class="block sm:inline"> Te hemos enviado un enlace de verificación a tu email. 
        Antes de continuar, por favor revisa tu bandeja de entrada.</span>
    </div>

    <p class="mb-4">¿No recibiste el correo?</p>

    {{-- Botón para reenviar --}}
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" 
            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Reenviar correo de verificación
        </button>
    </form>
</div>
@endsection
