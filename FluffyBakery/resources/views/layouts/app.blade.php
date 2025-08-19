<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
      .notification-dot { position: absolute; top: -2px; right: -2px; width: 8px; height: 8px; background: #ef4444; border-radius: 9999px; }
      .sidebar-item.active { background: #fef2f2; color: #b91c1c; }
    </style>
  </head>
  <body class="flex min-h-screen bg-gray-50 text-gray-900">
    <!-- Sidebar -->
    <aside id="sidebar" class="fixed md:static top-0 left-0 h-full w-64 bg-white shadow-md flex flex-col transform -translate-x-full md:translate-x-0 transition-all duration-300 z-50">
      <!-- Logo -->
      <div class="p-4 flex items-center justify-center border-b border-gray-200">
        <div class="flex items-center">
          <i class="fas fa-cookie-bite text-3xl mr-2" style="color: #FF8EA5;"></i>
          <span class="text-xl font-bold text-gray-800">Fluffy</span>
        </div>
      </div>

      <!-- User Profile -->
      <div class="p-4 flex items-center border-b border-gray-200">
        <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full mr-3">
        <div>
          <p class="font-medium text-gray-800">Luna Repostera</p>
          <p class="text-xs text-gray-500">Administradora</p>
        </div>
      </div>

      <!-- Menu -->
      <nav class="flex-1 overflow-y-auto">
        <ul class="py-2">
          <li>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-700">
              <i class="fas fa-shopping-bag mr-3"></i>
              <span>Ventas</span>
              <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">5 nuevas</span>
            </a>
          </li>
          <li>
            <a href="{{ route('productos.index') }}" class="sidebar-item flex items-center px-4 py-3 text-gray-700 {{ request()->is('productos*') ? 'active' : '' }}">
              <i class="fas fa-cookie mr-3"></i>
              <span>Productos</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-700">
              <i class="fas fa-images mr-3"></i>
              <span>Galería</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-700">
              <i class="fas fa-users mr-3"></i>
              <span>Clientes</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-700">
              <i class="fas fa-chart-line mr-3"></i>
              <span>Reportes</span>
            </a>
          </li>
          <li>
            <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-700">
              <i class="fas fa-cog mr-3"></i>
              <span>Configuración</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Logout -->
      <div class="p-4 border-t border-gray-200">
        <a href="#" class="flex items-center text-gray-700 hover:text-red-500">
          <i class="fas fa-sign-out-alt mr-3"></i>
          <span>Cerrar sesión</span>
        </a>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
      <!-- Top Navigation -->
      <header class="bg-white shadow-sm z-10">
        <div class="flex items-center justify-between px-6 py-3">
          <!-- Mobile menu button -->
          <button class="md:hidden text-gray-600 focus:outline-none" id="toggleSidebar">
            <i class="fas fa-bars text-xl"></i>
          </button>

          <!-- Search -->
          <form action="{{ route('productos.index') }}" method="GET" class="relative mx-4 flex-1 max-w-md">
            <input type="hidden" name="category" value="{{ request('category','pasteles') }}">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar productos..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-transparent">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
          </form>

          <!-- Right side icons -->
          <div class="flex items-center space-x-4">
            <button class="relative text-gray-600 hover:text-gray-800">
              <i class="fas fa-bell text-xl"></i>
              <span class="notification-dot"></span>
            </button>
            <button class="relative text-gray-600 hover:text-gray-800">
              <i class="fas fa-envelope text-xl"></i>
              <span class="notification-dot"></span>
            </button>
            <div class="h-8 w-8 rounded-full bg-pink-200 flex items-center justify-center">
              <span class="text-pink-700 font-medium">LR</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Main content -->
      <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
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
