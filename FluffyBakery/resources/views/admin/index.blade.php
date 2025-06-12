<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluffy - Panel de Prdministrar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="./style/style.css">
    
</head>
<body class="flex h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="sidebar w-64 bg-white shadow-md flex flex-col">
        <!-- Logo -->
        <div class="p-4 flex items-center justify-center border-b border-gray-200">
            <div class="flex items-center">
                <i class="fas fa-cookie-bite text-3xl mr-2" style="color: #FF8EA5;"></i>
                <span class="text-xl font-bold text-gray-800">Fluffy</span>
            </div>
        </div>
        
        <!-- Usuar Profile -->
        <div class="p-4 flex items-center border-b border-gray-200">
            <img src="./img/user-admin.png" alt="User" class="w-10 h-10 rounded-full mr-3">
            <div>
                <p class="font-medium text-gray-800">Luna Repostera</p>
                <p class="text-xs text-gray-500">Administradora</p>
            </div>
        </div>
        
        <!-- Menu -->
        <div class="flex-1 overflow-y-auto">
            <ul class="py-2">
               
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-700">
                        <i class="fas fa-shopping-bag mr-3"></i>
                        <span>Ventas</span>
                        <span class="ml-auto bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">5 nuevas</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item active flex items-center px-4 py-3 text-gray-700">
                        <i class="fas fa-cookie mr-3"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center px-4 py-3 text-gray-700">
                        <i class="fas fa-boxes mr-3"></i>
                        <span>Inventario</span>
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
        </div>
        
        <!-- Logout -->
        <div class="p-4 border-t border-gray-200">
            <a href="#" class="flex items-center text-gray-700 hover:text-red-500">
                <i class="fas fa-sign-out-alt mr-3"></i>
                <span>Cerrar sesión</span>
            </a>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Top Navigation -->
        <header class="bg-white shadow-sm z-10">
            <div class="flex items-center justify-between px-6 py-3">
                <!-- Mobile menu button -->
                <button class="md:hidden text-gray-600 focus:outline-none" id="menu-toggle">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- Search -->
                <div class="relative mx-4 flex-1 max-w-md">
                    <input type="text" placeholder="Buscar..." class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-200 focus:border-transparent">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                
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
                        <span class="text-pink-700 font-medium">AR</span>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            
            <!-- Productos Tabla -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Productos</h2>
                    <button class="btn-primary px-4 py-2 rounded-lg flex items-center">
                        <i class="fas fa-plus mr-2"></i>
                        Nuevo Producto
                    </button>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Imagen</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Categoría</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Precio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Sample Product Row -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="https://via.placeholder.com/60" alt="Product" class="h-10 w-10 rounded-full object-cover">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Pastel de Chocolate</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Pasteles</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">$12.99</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">15</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Activo
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-3 py-1 rounded-md mr-2">
                                        <i class="fas fa-edit mr-1"></i> Editar
                                    </button>
                                    <button class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded-md">
                                        <i class="fas fa-trash mr-1"></i> Eliminar
                                    </button>
                                </td>
                            </tr>
                            
                            <!-- More sample rows -->
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="https://via.placeholder.com/60" alt="Product" class="h-10 w-10 rounded-full object-cover">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Galletas de Vainilla</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Galletas</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">$5.99</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">8</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Bajo Stock
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="https://via.placeholder.com/60" alt="Product" class="h-10 w-10 rounded-full object-cover">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Cupcakes de Fresa</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-500">Cupcakes</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">$3.50</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">22</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Activo
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- paginas -->
                <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                    <div class="flex-1 flex justify-between sm:hidden">
                        <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Anterior
                        </a>
                        <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                            Siguiente
                        </a>
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm text-gray-700">
                                Mostrando
                                <span class="font-medium">1</span>
                                a
                                <span class="font-medium">3</span>
                                de
                                <span class="font-medium">12</span>
                                resultados
                            </p>
                        </div>
                        <div>
                            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Anterior</span>
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                                <a href="#" aria-current="page" class="z-10 bg-pink-50 border-pink-500 text-pink-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    1
                                </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    2
                                </a>
                                <a href="#" class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    3
                                </a>
                                <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                    <span class="sr-only">Siguiente</span>
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="./java/js.js"></script>
   
</body>
</html>