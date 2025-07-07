<!-- <div class="flex bg-pink-300 h-20 items-center">
        <div class="">
            <div class="flex justify-between space-x-2">
                <div class="">
                    <div class="text-lg text-white font-semibold">
                        <a class="" href="">Ayuda</a>
                        <span class="">|</span>
                        <a class="" href="">Soporte</a>
                    </div>
                </div>
                <div class="">
                    <div class="text-white">
                        <a class="" href="https://www.instagram.com/fluffybakeryshop?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="" href="">
                            <i class="fas fa-user"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    

<!-- <nav class="bg-pink-300 h-20">
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ asset('storage/img/logo.jpeg') }}" class="h-10" alt="Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Fluffy Bakery</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
        </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0">
        <li>
          <a href="#" class="block py-2 px-3 text-white bg-pink-500 rounded-sm md:bg-transparent md:text-pink-500 md:p-0 text-white md:text-pink-500 md:p-0 dark:text-white md:dark:hover:text-pink-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Inicio</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-pink-500 md:p-0 dark:text-white md:dark:hover:text-pink-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Productos</a>
        </li>
        <li>
          <a href="#" class="block py-2 px-3 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-pink-500 md:p-0 dark:text-white md:dark:hover:text-pink-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">¿Quiénes somos?</a>
        </li>
      </ul>
    </div>
  </div>
</nav> -->






<!-- Topbar Start -->
    <div class="bg-pink-300 py-3 hidden md:block">
        <div class="container mx-auto px-4">
            <div class="flex justify-center lg:justify-end">
                <div class="flex items-center space-x-4">
                    <a class="text-white px-3 hover:text-blue-100 transition-colors" href="https://www.instagram.com/fluffybakeryshop?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <div class="relative group">
                        <a href="#" class="inline-block bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-pink-200 transition-colors btn-hover">Inicia Sesión</a>
                        <a href="#" class="inline-block bg-white text-black px-6 py-3 rounded-lg font-semibold hover:bg-pink-200 transition-colors btn-hover">Regístrate</a>
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