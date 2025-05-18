<x-layouts.app title="Asignar Grupo">
    <div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-purple-800 via-purple-900 to-purple-950 p-6">
        <div class="w-full max-w-lg bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-8 border border-purple-300 dark:border-purple-800">
            
            <h1 class="text-3xl font-bold text-center text-purple-700 dark:text-purple-300 mb-6">
                Asignar Grupo y Materia
            </h1>

            {{-- Éxito --}}
            @if (session('status'))
                <div class="mb-4 bg-green-200 text-green-900 px-4 py-3 rounded shadow">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Errores --}}
            @if ($errors->any())
                <div class="mb-4 bg-red-100 text-red-800 px-4 py-3 rounded shadow">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Formulario --}}
            <form action="{{ route('administrador.asignargrupo.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Grupo --}}
                <div>
                    <label class="block text-sm font-semibold text-purple-700 dark:text-purple-300 mb-1">Grupo</label>
                    <input type="text" name="nombre" required
                        class="w-full p-3 rounded-lg bg-gray-50 dark:bg-gray-800 border border-purple-300 dark:border-purple-600 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                </div>

                {{-- Materia --}}
                <div>
                    <label class="block text-sm font-semibold text-purple-700 dark:text-purple-300 mb-1">Materia</label>
                    <input type="text" name="materia" required
                        class="w-full p-3 rounded-lg bg-gray-50 dark:bg-gray-800 border border-purple-300 dark:border-purple-600 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                </div>

                {{-- Docente --}}
                <div>
                    <label class="block text-sm font-semibold text-purple-700 dark:text-purple-300 mb-1">Docente</label>
                    <select name="docente_id" required
                        class="w-full p-3 rounded-lg bg-gray-50 dark:bg-gray-800 border border-purple-300 dark:border-purple-600 text-black dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 shadow-sm">
                        <option value="">Selecciona un docente</option>
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Botón --}}
                <div>
                    <button type="submit"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-semibold transition shadow-md">
                        Asignar Grupo
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
