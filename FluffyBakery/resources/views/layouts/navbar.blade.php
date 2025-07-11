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