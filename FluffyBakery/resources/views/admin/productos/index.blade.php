@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
  
</style>

<div class="bg-white rounded-lg shadow overflow-hidden">
  <div class="p-4 border-b flex justify-between items-center">
    <h2 class="text-lg font-semibold text-gray-800">Productos</h2>
    <a href="{{ route('productos.create') }}" class="px-4 py-2 rounded-lg flex items-center bg-pink-300 text-white py-2 rounded hover:bg-pink-400 cursor-pointer">
      <i class="fas fa-plus mr-2"></i>
      Nuevo Producto
    </a>
  </div>

  <!-- Categorías -->
  <div class="p-4 border-b bg-gray-50">
    <div class="flex flex-wrap gap-2">
      <a href="{{ route('productos.index', ['category' => 'pasteles']) }}" class="tab-button {{ ($activeCategory ?? request('category','pasteles')) === 'pasteles' ? 'active' : '' }}">
        <i class="fas fa-birthday-cake mr-2"></i>Pasteles
      </a>
      <a href="{{ route('productos.index', ['category' => 'cupcakes']) }}" class="tab-button {{ ($activeCategory ?? request('category')) === 'cupcakes' ? 'active' : '' }}">
        <i class="fas fa-ice-cream mr-2"></i>Cupcakes
      </a>
      <a href="{{ route('productos.index', ['category' => 'galletas']) }}" class="tab-button {{ ($activeCategory ?? request('category')) === 'galletas' ? 'active' : '' }}">
        <i class="fas fa-cookie-bite mr-2"></i>Galletas
      </a>
      <a href="{{ route('productos.index', ['category' => 'rellenos']) }}" class="tab-button {{ ($activeCategory ?? request('category')) === 'rellenos' ? 'active' : '' }}">
        <i class="fas fa-cheese mr-2"></i>Rellenos
      </a>
      <a href="{{ route('productos.index', ['category' => 'brownies']) }}" class="tab-button {{ ($activeCategory ?? request('category')) === 'brownies' ? 'active' : '' }}">
        <i class="fas fa-square mr-2"></i>Brownies
      </a>
      <a href="{{ route('productos.index', ['category' => 'alfajores']) }}" class="tab-button {{ ($activeCategory ?? request('category')) === 'alfajores' ? 'active' : '' }}">
        <i class="fas fa-cookie mr-2"></i>Alfajores
      </a>
    </div>
  </div>

  <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
      <thead class="bg-gray-50">
        <tr>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
          <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody class="bg-white h-20 divide-y divide-gray-200">
        @forelse($productos as $producto)
        <tr>
          <td class="px-6 py-4 whitespace-nowrap">
            @if($producto->image)
              <img src="{{ asset('storage/products/'.$producto->image) }}" alt="{{ $producto->product_name }}" class="size-20 rounded-full object-cover">
            @else
              <span class="text-gray-400 text-sm">Sin imagen</span>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm font-medium text-gray-900">{{ $producto->product_name }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">${{ number_format($producto->price, 2) }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            <div class="text-sm text-gray-900">{{ $producto->available_unity }}</div>
          </td>
          <td class="px-6 py-4 whitespace-nowrap">
            @if($producto->status)
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Activo</span>
            @else
              <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Inactivo</span>
            @endif
          </td>
          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            <div class="flex items-center gap-2">
              <a href="{{ route('productos.edit', $producto->product_code) }}" class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-3 py-1 rounded-md">
                <i class="fas fa-edit mr-1"></i> Editar
              </a>
              <form action="{{ route('productos.destroy', $producto->product_code) }}" method="POST" onsubmit="return confirm('¿Seguro de eliminar este producto?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded-md">
                  <i class="fas fa-trash mr-1"></i> Eliminar
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-6 text-gray-500">No hay productos registrados.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Paginación -->
    <div class="mt-4 px-4 pb-4">
      {{ $productos->appends(request()->query())->links() }}
    </div>
  </div>
</div>

<!-- Navegación por categorías via enlace; no se requiere JS adicional -->
@endsection
