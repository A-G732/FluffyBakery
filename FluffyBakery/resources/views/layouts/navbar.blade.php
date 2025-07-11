<!-- Topbar Start -->
<div class="bg-pink-300 hidden md:block">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-3">
            <!-- Ayuda | Soporte -->
            <div class="flex items-center space-x-4">
                <a class="text-white px-2 hover:text-blue-100 transition-colors" href="#">Ayuda</a>
                <span class="text-white">|</span>
                <a class="text-white px-2 hover:text-blue-100 transition-colors" href="#">Soporte</a>
            </div>

            <!-- Instagram and User -->
            <div class="flex items-center space-x-4">
                <!-- Instagram -->
                <a class="text-white px-3 hover:text-blue-100 transition-colors"
                    href="https://www.instagram.com/fluffybakeryshop?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw=="
                    target="_blank">
                    <i class="fab fa-instagram text-xl"></i>
                </a>
                <!-- User Dropdown -->
                <div class="relative">
                    <!-- Botón de usuario -->
                    <button id="userDropdownButton" class="text-white px-3 focus:outline-none" onclick="toggleDropdown()">
                        <i class="fas fa-user"></i>
                    </button>

                    <!-- Dropdown -->
                    <ul id="userDropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg hidden z-50">
                        <li>
                            <button onclick="openModal('loginModal')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-700">
                                Inicia Sesión
                            </button>
                        </li>
                        <li>
                            <button onclick="openModal('registerModal')" class="block w-full text-left px-4 py-2 hover:bg-gray-100 text-gray-700">
                                Regístrate
                            </button>
                        </li>
                    </ul>

                    <!-- Modal Login -->
                    <div id="loginModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                        <div class="bg-white rounded-lg w-full max-w-md p-6 relative">
                            <button onclick="closeModal('loginModal')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                                &times;
                            </button>
                            @include('modules.auth.login')
                            <div class="text-center mt-3">
                                <p>¿Aún no tienes cuenta?
                                    <button onclick="switchModal('loginModal', 'registerModal')" class="text-blue-600 hover:underline">
                                        Regístrate aquí
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Register -->
                    <div id="registerModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
                        <div class="bg-white rounded-lg w-full max-w-md p-6 relative">
                            <button onclick="closeModal('registerModal')" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
                                &times;
                            </button>
                            @include('modules.auth.registro')
                            <div class="text-center mt-3">
                                <p>¿Ya estás registrado?
                                    <button onclick="switchModal('registerModal', 'loginModal')" class="text-blue-600 hover:underline">
                                        Inicia sesión aquí
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

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
<!-- Navbar End -->