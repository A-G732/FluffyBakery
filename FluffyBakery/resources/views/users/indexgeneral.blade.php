<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset ('style.css') }}">
    <script src="{{ asset('script.js') }}"></script>
    <link href="{{ asset('storage/img/logo.jpeg') }}" rel="icon">
    <title>Fluffy Bakery</title>
</head>
<body>
    <!--Navbar-->
    @include('layouts.navbar')
    <!--Fin Navbar-->

    <!-- Carrousel -->
        
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
             <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage//img/galletasyvelas.jpeg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 2 -->
                <div class="duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage//img/galletachocolate1.jpeg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 3 -->
                <div class="duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('storage//img/galletaarequipe1.jpeg') }}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="#" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="#" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                </div>
            </div>

             <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            </div>

            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

    <!-- Fin Carrousel -->

    <!-- Producto destacado  -->
        <section class="py-16 bg-gray-100 text-center">
            <h2 class="text-3xl font-bold mb-6">Producto Destacado</h2>
            <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-8">
                <img src="{{ asset('storage/img/galletapiedelimon1.jpeg') }}" alt="Producto Destacado" class="mx-auto w-64 h-64 object-cover rounded">
                <h3 class="text-xl font-semibold mt-4">Galleta Pie de limón</h3>
                <p class="mt-2 text-gray-600">La favorita de la casa que siempre está en nuestro top 1, nuestra galelta pie de limón.</p>
            </div>
        </section>
    <!-- Fin producto destacado -->

    <!-- Reseña de quienes somos -->
        <!-- Quiénes Somos -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-6 flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <img src="{{ asset('storage/img/todasgalletasgeneral.jpeg') }}" alt="Quiénes Somos" class="rounded shadow-lg mx-auto w-64 h-64 object-cover rounded">
                </div>
                <div class="md:w-1/2 md:pl-10">
                    <h2 class="text-3xl font-bold mb-4">¿Quiénes Somos?</h2>
                    <p class="text-gray-700 mb-6">Somos una reposteria que busca esparcir amor y felicidad a nuestros amigos y seres queridos por medio de tortas, galletas y postres que hagan nuestros días distintos.</p>
                    
                </div>
            </div>
        </section>


    <!-- Fin de reseña -->

    <!-- Footer -->
     @include('layouts.footer')
    <!-- Fin de foooter -->
</body>
</html>