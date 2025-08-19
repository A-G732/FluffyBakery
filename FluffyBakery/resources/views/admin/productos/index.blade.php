@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <!-- Header de la tabla -->
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-primary">Productos</h2>
        <a href="{{ route('productos.create') }}"
           class="bg-primary hover:bg-primary-dark text-white px-4 py-2 rounded-lg shadow">
            + Nuevo Producto
        </a>
    </div>

    <!-- Tabla de productos -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
            <thead class="bg-primary-light text-primary-dark">
                <tr>
                    <th class="px-3 py-2 border">Imagen</th>
                    <th class="px-3 py-2 border">Código</th>
                    <th class="px-3 py-2 border">Categoría</th>
                    <th class="px-3 py-2 border">Nombre</th>
                    <th class="px-3 py-2 border">Precio</th>
                    <th class="px-3 py-2 border">Stock</th>
                    <th class="px-3 py-2 border">Estado</th>
                    <th class="px-3 py-2 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                <tr class="hover:bg-gray-50 transition">
                    <!-- Imagen -->
                    <td class="px-3 py-2 border text-center">
                        @if($producto->image)
                            <img src="{{ asset('storage/products/'.$producto->image) }}"
                                class="h-28 object-cover rounded-lg border-2 border-primary-light">
                        @else
                            <span class="text-gray-400 text-sm">Sin imagen</span>
                        @endif
                    </td>

                    <!-- Código -->
                    <td class="px-3 py-2 border text-sm">{{ $producto->product_code }}</td>

                    <!-- Categoría -->
                    <td class="px-3 py-2 border text-sm">{{ $producto->id_category }}</td>

                    <!-- Nombre -->
                    <td class="px-3 py-2 border font-semibold">{{ $producto->product_name }}</td>

                    <!-- Precio -->
                    <td class="px-3 py-2 border">${{ number_format($producto->price, 2) }}</td>

                    <!-- Stock -->
                    <td class="px-3 py-2 border">{{ $producto->available_unity }}</td>

                    <!-- Estado -->
                    <td class="px-3 py-2 border text-center">
                        @if($producto->status)
                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Activo</span>
                        @else
                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Inactivo</span>
                        @endif
                    </td>

                    <!-- Acciones -->
                    <td class="px-3 py-2 border text-center">
                        <div class="flex justify-center space-x-2">
                            <!-- Botón Editar -->
                            <a href="{{ route('productos.edit', $producto->product_code) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 shadow">
                                ✏️ Editar
                            </a>

                            <!-- Botón Eliminar -->
                            <form action="{{ route('productos.destroy', $producto->product_code) }}" method="POST"
                                  onsubmit="return confirm('¿Seguro de eliminar este producto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1 bg-red-600 text-white rounded-lg hover:bg-red-700 shadow">
                                    🗑 Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center py-6 text-gray-500">
                        No hay productos registrados.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-4">
        {{ $productos->links() }}
    </div>
</div>
@endsection
