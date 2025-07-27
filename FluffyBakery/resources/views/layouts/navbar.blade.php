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
                    <!-- Botón del dropdown -->
                    <button id="userDropdownButton" onclick="toggleDropdown()" class="text-white px-3 cursor-pointer">
                        <i class="fas fa-user"></i>
                    </button>

                    <!-- Menú del dropdown -->
                    <div id="userDropdownMenu" class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden z-50">
                        <a href="{{ route('login') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Regístrate</a>
                    </div>
                </div>
                <!-- Fin dropdown -->
                <!-- Modal login -->
                <div id="loginModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        @include('modules.auth.login')
                    </div>
                </div>
                <!-- Fin modal login -->
                <!-- modal register -->
                <div id="registerModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
                    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
                        @include('modules.auth.register')
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
</script>

<!-- Navbar End -->