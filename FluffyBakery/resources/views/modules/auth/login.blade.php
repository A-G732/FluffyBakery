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
                @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" required class="w-full border border-gray-300 rounded-md px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
                @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full bg-pink-400 text-white py-2 rounded hover:bg-pink-500 cursor-pointer">Entrar</button>
        </form>
    </div>
</div>