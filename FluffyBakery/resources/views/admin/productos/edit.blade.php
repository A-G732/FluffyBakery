@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4 text-primary">Editar Producto</h2>
    @include('admin.productos.form', ['producto' => $producto])
</div>
@endsection
