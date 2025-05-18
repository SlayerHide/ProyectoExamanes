<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-gradient-to-br from-[#1f1f47] to-[#0a0a23]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen w-screen overflow-hidden text-white font-sans">

    <div class="flex h-full w-full">

        <!-- Imagen o sección izquierda -->
        <div class="hidden lg:flex w-1/2 bg-cover bg-center relative"
             style="background-image: url('https://images.unsplash.com/photo-1605902711622-cfb43c44367e?auto=format&fit=crop&w=1050&q=80');">
            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                <h2 class="text-4xl font-bold text-white px-10 text-center">Bienvenido a<br>The Exam's Brain</h2>
            </div>
        </div>

        <!-- Formulario -->
        <div class="w-full lg:w-1/2 flex items-center justify-center bg-white dark:bg-gray-900">
            <div class="w-full max-w-md p-8 space-y-6 bg-white dark:bg-gray-900 rounded-lg shadow-xl">
                {{-- LOGO O NOMBRE --}}
                <div class="text-center">
                    <img src="/logo.svg" alt="Logo" class="mx-auto h-10">
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white mt-4">Iniciar sesión</h1>
                    <p class="text-gray-500 dark:text-gray-400 text-sm">Accede a tu cuenta</p>
                </div>

                {{-- SLOT = contenido del login generado por Livewire --}}
                {{ $slot }}

                {{-- Footer (opcional) --}}
                <p class="text-center text-xs text-gray-500 mt-6">&copy; {{ now()->year }} The Exam's Brain. Todos los derechos reservados.</p>
            </div>
        </div>

    </div>

</body>
</html>
