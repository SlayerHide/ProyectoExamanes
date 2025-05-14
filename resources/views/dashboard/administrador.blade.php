<x-layouts.app title="Dashboard del Administrador">
    <div class="p-6 bg-purple-100 min-h-screen">
        <h1 class="text-3xl font-bold text-purple-800 mb-4">Bienvenido, {{ Auth::user()->name }}</h1>
        <p class="text-gray-700 mb-8">Este es tu panel de control como administrador.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Asignar Grupos -->
            <a href="{{ route('administrador.asignargrupo') }}" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
                <h2 class="text-xl font-bold text-purple-700 mb-2">Asignar Grupos</h2>
                <p class="text-gray-600 dark:text-gray-300">Crea grupos y asigna materias a docentes.</p>
            </a>

            <!-- Asignar Alumnos a Grupo -->
            <a href="{{ route('grupos.asignarAlumnos') }}" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
                <h2 class="text-xl font-bold text-purple-700 mb-2">Asignar Alumnos</h2>
                <p class="text-gray-600 dark:text-gray-300">Agrega alumnos a grupos ya creados.</p>
            </a>

            <!-- Gestión de Roles -->
            <a href="{{ route('administrador.usuarios_pendientes') }}" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
                <h2 class="text-xl font-bold text-purple-700 mb-2">Gestión de Roles</h2>
                <p class="text-gray-600 dark:text-gray-300">Asigna o modifica roles de usuarios.</p>
            </a>

            <!-- Usuarios o Alumnos -->
            <a href="{{ route('administrador.usuarios_pendientes') }}" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
                <h2 class="text-xl font-bold text-purple-700 mb-2">Usuarios</h2>
                <p class="text-gray-600 dark:text-gray-300">Consulta y administra todos los usuarios.</p>
            </a>
        </div>
    </div>
</x-layouts.app>