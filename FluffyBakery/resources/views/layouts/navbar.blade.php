<!-- Topbar Start -->
<div class="bg-pink-300 hidden md:block">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            <!-- Ayuda | Soporte -->
            <div class="flex items-center space-x-4">
                <a class="text-white px-2" href="#">Ayuda</a>
                <span class="text-white">|</span>
                <a class="text-white px-2" href="#">Soporte</a>
            </div>

            <!-- Instagram and User -->
            <div class="flex items-center space-x-4">
                <!-- Instagram -->
                <a class="text-white px-3"
                    href="https://www.instagram.com/fluffybakeryshop?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                    target="_blank">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <!-- User Dropdown -->
                <div class="relative inline-block text-left">
                    <!-- Botón -->
                    <button id="userDropdownButton" onclick="toggleDropdown()" class="text-white px-3 cursor-pointer">
                        <i class="fas fa-user"></i>
                    </button>
                    <!-- Menú -->
                    <div id="userDropdownMenu" class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden z-50">
                        <button onclick="openModal('loginModal')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">Iniciar Sesión</button>
                        <button onclick="openModal('registerModal')" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100 cursor-pointer">Regístrate</button>
                    </div>
                </div>
                <!-- Fin dropdown -->
                <!-- Modal login -->
                <div id="loginModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden">
                    <div class="bg-white w-full max-w-md p-6 rounded-lg relative">
                        <!-- Botón cerrar (X) -->
                        <button onclick="toggleModal('loginModal')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-3xl font-bold cursor-pointer">&times;</button>

                        <h2 class="text-2xl font-bold mb-4 text-center">Iniciar Sesión</h2>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Correo electrónico</label>
                                <input type="email" name="email" id="email" required class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Contraseña</label>
                                <input type="password" name="password" id="password" required class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <button type="submit" class="w-full bg-pink-400 text-white py-2 rounded hover:bg-pink-500 cursor-pointer">Entrar</button>
                        </form>
                    </div>
                </div>
                <!-- Fin modal login -->
                <!-- modal register -->
                <div id="registerModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 hidden">
                    <div class="bg-white w-full max-w-md p-6 rounded-lg relative">
                        <!-- Botón cerrar (X) -->
                        <button onclick="toggleModal('registerModal')" class="absolute top-2 right-2 text-gray-500 hover:text-gray-800 text-xl font-bold cursor-pointer">&times;</button>

                        <h2 class="text-2xl font-bold mb-4 text-center">Registro</h2>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-gray-700">Nombre</label>
                                <input type="text" name="name" id="name" required class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Correo electrónico</label>
                                <input type="email" name="email" id="email" required class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Contraseña</label>
                                <input type="password" name="password" id="password" required class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="block text-gray-700">Confirmar Contraseña</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" required class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                            </div>
                            <button type="submit" class="w-full bg-pink-400 text-white py-2 rounded hover:bg-pink-500 cursor-pointer">Registrarse</button>
                        </form>
                    </div>
                </div>
                <!-- Fin modal register -->

            </div>
        </div>
    </div>
</div>

<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="bg-white shadow-lg sticky top-0 z-40">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Mobile menu button -->
            <button class="md:hidden text-gray-600 hover:text-gray-900" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-xl"></i>
            </button>

            <!-- Left Navigation (hidden on mobile) -->
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium">Inicio</a>
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium">Productos</a>
            </div>

            <!-- Logo -->
            <a href="#" class="text-4xl font-bold text-primary hover:scale-105 transition-transform">
                FLUFFY
            </a>

            <!-- Right Navigation (hidden on mobile) -->
            <div class="hidden md:flex space-x-8">
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium">¿Quiénes Somos?</a>
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium">Contáctanos</a>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="md:hidden hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium py-2">Inicio</a>
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium py-2">Productos</a>
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium py-2">¿Quiénes Somos?</a>
                <a href="#" class="text-gray-700 hover:text-primary transition-colors font-medium py-2">Contáctanos</a>
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('userDropdownMenu');
        dropdown.classList.toggle('hidden');
    }

    // Cerrar si se hace clic fuera del dropdown
    window.addEventListener('click', function(e) {
        const button = document.getElementById('userDropdownButton');
        const menu = document.getElementById('userDropdownMenu');
        if (!button.contains(e.target) && !menu.contains(e.target)) {
            menu.classList.add('hidden');
        }
    });

    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }

    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }
</script>

<!-- Navbar End -->