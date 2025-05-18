<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Alpine.js para interactividad -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>The Exam's Brain</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Color Palette -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#7C3AED', // morado
                        secondary: '#EEF2FF',
                        accent: '#4F46E5',
                    },
                    fontFamily: {
                        sans: ['Instrument Sans', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-secondary min-h-screen font-sans text-gray-800 dark:bg-gray-900 dark:text-white">

    <!-- Navegación -->
    <header class="w-full px-8 py-4 bg-white dark:bg-gray-800 shadow flex justify-between items-center">
        <h1 class="text-xl font-bold text-primary">The Exam's Brain</h1>
        <nav class="space-x-4">
            @auth
                @php $rol = Auth::user()->rol; @endphp
                @if ($rol === 'administrador')
                    <a href="{{ route('dashboard.administrador') }}" class="text-primary hover:underline">Administrador</a>
                @elseif ($rol === 'docente')
                    <a href="{{ route('dashboard.docente') }}" class="text-primary hover:underline">Docente</a>
                @elseif ($rol === 'alumno')
                    <a href="{{ route('dashboard.alumno') }}" class="text-primary hover:underline">Alumno</a>
                @endif
            @else
                <a href="{{ route('login') }}" class="text-sm font-semibold text-primary hover:underline">Iniciar sesión</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm font-semibold text-primary hover:underline">Registrarse</a>
                @endif
            @endauth
        </nav>
    </header>

    <!-- Contenido principal -->
    <main class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto px-6 py-16">
        <!-- Texto -->
        <div class="md:w-1/2 space-y-6 text-center md:text-left">
            <h2 class="text-4xl font-bold text-primary">Bienvenido a <br><span class="text-accent">The Exam's Brain</span></h2>
            <p class="text-lg text-gray-600 dark:text-gray-300">
                Plataforma para gestionar, crear y resolver exámenes de manera eficiente, organizada y segura.
            </p>
            <div class="flex justify-center md:justify-start gap-4 mt-6">
                <a href="{{ route('login') }}"
                   class="bg-primary hover:bg-purple-700 text-white px-6 py-2 rounded shadow transition font-semibold">
                    Empezar
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="bg-white dark:bg-gray-800 border border-primary text-primary px-6 py-2 rounded shadow hover:bg-primary hover:text-white transition font-semibold">
                        Crear cuenta
                    </a>
                @endif
            </div>
        </div>

        <!-- Imagen -->
    <!-- Carrusel de imágenes -->
<div x-data="{ active: 0, images: [
    'https://aguascalientes.tecnm.mx/carreras/img/tics.png',
    'https://www.familyandyou.co.uk/static/14f96a659aa619d685196fdc4af574a1/23d69e_99ff30c63a7a4b2da33645b69727c16d~mv2.jpg',
    'https://img.freepik.com/premium-photo/full-length-happy-college-students-walking-together-campus_763111-5386.jpg'
]}" x-init="setInterval(() => active = (active + 1) % images.length, 5000)" class="md:w-1/2 relative">

    <template x-for="(img, index) in images" :key="index">
        <div x-show="active === index" class="transition-opacity duration-700" x-transition>
            <img :src="img" alt="Imagen rotativa" class="rounded-xl shadow-lg w-full h-auto object-cover">
        </div>
    </template>

    <!-- Indicadores -->
    <div class="absolute bottom-3 left-1/2 transform -translate-x-1/2 flex gap-2">
        <template x-for="(img, index) in images" :key="index">
            <div @click="active = index"
                 :class="active === index ? 'bg-white' : 'bg-gray-400'"
                 class="w-3 h-3 rounded-full cursor-pointer transition-all duration-300"
                 :title="'Imagen ' + (index + 1)">
            </div>
        </template>
    </div>
</div>

    </main>

</body>

</html>
