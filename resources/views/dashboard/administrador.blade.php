<x-layouts.app title="Dashboard del Administrador">
    <div class="p-8 min-h-screen bg-gradient-to-tr from-indigo-100 to-violet-200 dark:from-gray-900 dark:to-gray-800">

        {{-- Bienvenida --}}
        <div class="max-w-4xl mx-auto text-center mb-12">
            <h1 class="text-4xl font-extrabold text-indigo-800 dark:text-indigo-300 mb-2">
                Bienvenido, {{ Auth::user()->name }}
            </h1>
            <p class="text-gray-700 dark:text-gray-300 text-lg">Este es tu panel de control como administrador.</p>
        </div>

        {{-- Tarjetas de Acciones --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">

            {{-- Asignar Grupos --}}
            <a href="{{ route('administrador.asignargrupo') }}"
               class="bg-white dark:bg-gray-900 border border-indigo-300 dark:border-indigo-700 p-6 rounded-2xl shadow hover:shadow-lg transform hover:-translate-y-1 transition">
                <div class="flex flex-col h-full justify-between">
                    <div>
                        <h2 class="text-xl font-semibold text-indigo-700 dark:text-indigo-300 mb-2">📘 Asignar Grupos</h2>
                        <p class="text-gray-600 dark:text-gray-400">Crea grupos y asigna materias a docentes fácilmente.</p>
                    </div>
                </div>
            </a>

            {{-- Asignar Alumnos --}}
            <a href="{{ route('grupos.asignarAlumnos') }}"
               class="bg-white dark:bg-gray-900 border border-indigo-300 dark:border-indigo-700 p-6 rounded-2xl shadow hover:shadow-lg transform hover:-translate-y-1 transition">
                <div>
                    <h2 class="text-xl font-semibold text-indigo-700 dark:text-indigo-300 mb-2">👥 Asignar Alumnos</h2>
                    <p class="text-gray-600 dark:text-gray-400">Agrega alumnos a grupos ya existentes de forma ordenada.</p>
                </div>
            </a>

            {{-- Usuarios Pendientes --}}
            <a href="{{ route('administrador.usuarios_pendientes') }}"
               class="bg-white dark:bg-gray-900 border border-indigo-300 dark:border-indigo-700 p-6 rounded-2xl shadow hover:shadow-lg transform hover:-translate-y-1 transition">
                <div>
                    <h2 class="text-xl font-semibold text-indigo-700 dark:text-indigo-300 mb-2">📝 Usuarios Pendientes</h2>
                    <p class="text-gray-600 dark:text-gray-400">Aprueba registros recientes y controla accesos al sistema.</p>
                </div>
            </a>

            {{-- Gestión de Usuarios --}}
            <a href="{{ route('administrador.usuarios') }}"
               class="bg-white dark:bg-gray-900 border border-indigo-300 dark:border-indigo-700 p-6 rounded-2xl shadow hover:shadow-lg transform hover:-translate-y-1 transition">
                <div>
                    <h2 class="text-xl font-semibold text-indigo-700 dark:text-indigo-300 mb-2">⚙️ Gestión de Usuarios</h2>
                    <p class="text-gray-600 dark:text-gray-400">Modifica, elimina o consulta los datos de usuarios registrados.</p>
                </div>
            </a>
             {{-- Crea Usuarios --}}
              

        </div>
    </div>
</x-layouts.app>
