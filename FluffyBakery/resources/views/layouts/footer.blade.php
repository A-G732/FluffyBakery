<footer class="bg-pink-300 text-white mt-10">
    <div class="max-w-screen-xl mx-auto px-4 py-8 md:py-10">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <!-- Logo e Identidad -->
            <a href="{{ route('indexgeneral') }}" class="flex items-center space-x-3 mb-4 md:mb-0">
                <img src="{{ asset('img/logo.jpeg') }}" alt="Logo" class="h-14 w-auto rounded-full shadow-md">
                <span class="text-xl font-semibold">Fluffy Bakery</span>
            </a>

            <!-- Navegación -->
            <ul class="flex flex-wrap gap-4 text-sm text-white">
                <li><a href="#" class="hover:text-white transition">Nosotros</a></li>
                <li><a href="#" class="hover:text-white transition">Política de privacidad</a></li>
                <li><a href="#" class="hover:text-white transition">Términos y condiciones</a></li>
                <li><a href="#" class="hover:text-white transition">Contacto</a></li>
            </ul>
        </div>

        <!-- Form Contact -->
        <form class="max-w-md mx-auto">
            <h2 class="content-center text-4xl dark:text-white font-serif">Contáctenos</h2><br>
            <div class="grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_first_name" id="floating_first_name" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white appearance-none text-white border-white focus:border-pink-400 focus:outline-none focus:ring-0 focus:border-pink-400 peer" placeholder=" " required />
                    <label for="floating_first_name" class="peer-focus:font-medium absolute text-sm text-white text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-pink-500 peer-focus:text-pink-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Primer nombre</label>
                    @error('firstname')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>
                <div class="relative z-0 w-full mb-5 group">
                    <input type="text" name="floating_last_name" id="floating_last_name" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white appearance-none text-white border-white focus:border-pink-400 focus:outline-none focus:ring-0 focus:border-pink-400 peer" placeholder=" " required />
                    <label for="floating_last_name" class="peer-focus:font-medium absolute text-sm text-white text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-pink-500 peer-focus:text-pink-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Apellido</label>
                    @error('lastname')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="email" name="floating_email" id="floating_email" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white appearance-none text-white border-white focus:border-pink-400 focus:outline-none focus:ring-0 focus:border-pink-400 peer" placeholder=" " required />
                <label for="floating_email" class="peer-focus:font-medium absolute text-sm text-white text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-pink-500 peer-focus:text-pink-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Correo electrónico</label>
                @error('email')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>
            <div class="relative z-0 w-full mb-5 group">
                <input type="message" name="floating_message" id="floating_message" class="block py-2.5 px-0 w-full text-sm text-white bg-transparent border-0 border-b-2 border-white appearance-none text-white border-white focus:border-pink-400 focus:outline-none focus:ring-0 focus:border-pink-400 peer" placeholder=" " required />
                <label for="floating_message" class="peer-focus:font-medium absolute text-sm text-white text-white duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-pink-500 peer-focus:text-pink-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Escribe tu mensaje...</label>
                @error('message')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>
            <button type="submit" class=" cursor-pointer text-white bg-pink-400 hover:bg-pink-500 focus:ring-4 focus:outline-none focus:ring-pink-400 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center bg-pink-400 hover:bg-pink-400">Enviar</button>
        </form>

        <!-- Fin Form Contact -->

        <hr class="my-6 border-white">

        <p class="text-center text-sm text-white">
            © {{ date('Y') }} <a href="{{ url('/') }}" class="hover:underline text-white">FluffyBakery™</a>. Todos los derechos reservados.
        </p>
    </div>
</footer>