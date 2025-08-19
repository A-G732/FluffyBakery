<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel de Administración - FluffyBakery</title>
  @vite('resources/js/app.js')
</head>
<body class="bg-gray-50 flex min-h-screen text-gray-900">

  <!-- Sidebar -->
  <aside id="sidebar"
         class="fixed md:static top-0 left-0 h-full w-64 bg-white shadow-lg transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50">
    <!-- Logo / Nombre -->
    <div class="p-4 text-2xl font-bold text-primary border-b border-primary-light">
      FluffyBakery
    </div>

    <!-- Navegación -->
    <nav class="flex flex-col mt-4 space-y-1">
      <a href="{{ route('productos.index') }}"
         class="px-4 py-2 rounded flex items-center gap-2 hover:bg-primary-light transition {{ request()->is('productos*') ? 'bg-primary text-white' : '' }}">
         📦 <span>Productos</span>
      </a>
      <a href="#" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-primary-light">
         👥 <span>Usuarios</span>
      </a>
      <a href="#" class="px-4 py-2 rounded flex items-center gap-2 hover:bg-primary-light">
         📊 <span>Reportes</span>
      </a>
    </nav>

    <!-- Footer -->
    <div class="absolute bottom-0 w-full p-4 border-t border-primary-light">
      <a href="#" class="text-sm text-gray-500 hover:text-primary">Cerrar sesión</a>
    </div>
  </aside>

  <!-- Contenido principal -->
  <div class="flex-1 flex flex-col">
    <!-- Header -->
    <header class="bg-white shadow p-4 flex justify-between items-center">
      <!-- Botón móvil -->
      <button id="toggleSidebar"
              class="md:hidden px-3 py-2 rounded bg-primary text-white hover:bg-primary-dark">
        ☰
      </button>
      <h1 class="text-xl font-bold">Panel de Administración</h1>
      <div class="flex items-center gap-3">
        <span class="font-semibold">👤 Admin</span>
        <div class="relative">
          <button class="relative">
            🔔
            <!-- Punto de notificación -->
            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
          </button>
        </div>
      </div>
    </header>

    <!-- Main content -->
    <main class="p-6">
      @yield('content')
    </main>
  </div>

  <!-- Script para sidebar responsivo -->
  <script>
    const btn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    btn?.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>
</body>
</html>
