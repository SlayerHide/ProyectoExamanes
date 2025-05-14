<x-layouts.app title="Asignar Grupo">
    <div class="flex flex-col items-center justify-center min-h-screen p-6 bg-purple-100 dark:bg-purple-900">
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h1 class="text-2xl font-bold text-center text-purple-800 dark:text-purple-200">Asignar Grupo y Materia</h1>

            @if (session('status'))
            <div class="mt-4 bg-green-200 text-green-900 px-4 py-3 rounded">
                {{ session('status') }}
            </div>
            @endif

            @if ($errors->any())
            <div class="mt-4 bg-red-200 text-red-900 px-4 py-3 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('administrador.asignargrupo.store') }}" method="POST" class="mt-6">
                @csrf
                <label class="block text-purple-700 dark:text-purple-300 font-semibold">Grupo</label>
                <input type="text" name="nombre" required
                    class="w-full p-3 mt-2 rounded-lg border border-purple-300 focus:ring-2 focus:ring-purple-500">

                <label class="block mt-4 text-purple-700 dark:text-purple-300 font-semibold">Materia</label>
                <input type="text" name="materia" required
                    class="w-full p-3 mt-2 rounded-lg border border-purple-300 focus:ring-2 focus:ring-purple-500">

                <label class="block mt-4 text-purple-700 dark:text-purple-300 font-semibold">Docente</label>
                <select name="docente_id" required
                    class="w-full p-3 mt-2 rounded-lg border border-purple-300 focus:ring-2 focus:ring-purple-500">
                    <option value="">Selecciona un docente</option>
                    @foreach ($docentes as $docente)
                    <option value="{{ $docente->id }}">{{ $docente->name }}</option>
                    @endforeach
                </select>

                <button type="submit"
                    class="mt-6 w-full bg-purple-500 text-white p-3 rounded-lg shadow-md hover:bg-purple-600 transition">
                    Asignar Grupo
                </button>
            </form>
        </div>
    </div>
</x-layouts.app>