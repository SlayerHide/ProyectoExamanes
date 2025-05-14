<x-layouts.app>
    <div class="p-4">
        <h1 class="text-2xl font-bold">Bienvenido al Dashboard del Alumno</h1>
        <p>Bienvenido {{ Auth::user()->name }}, este tu panel de control como alumno.</p>


         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
           
          <a href="{{ route('alumno.examenes.disponibles') }}" class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 p-6 rounded-xl shadow-md hover:shadow-lg transition transform hover:scale-105">
    <h2 class="text-xl font-bold text-purple-700 mb-2">Hacer Examen</h2>
    <p class="text-gray-600 dark:text-gray-300">Contesta exámenes disponibles.</p>
</a>

        </div>
    </div>
</x-layouts.app>