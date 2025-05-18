<x-layouts.app title="Asignar Alumnos a Grupo">
    <div class="flex flex-col items-center justify-center min-h-screen p-6 bg-gradient-to-r from-slate-800 via-slate-900 to-gray-950">
        <div class="w-full max-w-3xl bg-white dark:bg-gray-900 shadow-2xl rounded-2xl p-8 border border-gray-300 dark:border-gray-700">

            <h2 class="text-3xl font-bold text-center text-indigo-700 dark:text-indigo-300 mb-4">
                Asignar Alumnos a Grupo
            </h2>

            {{-- Éxito --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-800 px-4 py-3 rounded shadow">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('grupos.asignarAlumnos') }}" class="space-y-6">
                @csrf

                {{-- Grupo --}}
                <div>
                    <label for="grupo_id" class="block font-semibold text-indigo-700 dark:text-indigo-300">Seleccionar grupo:</label>
                    <select name="grupo_id" id="grupo_id" required
                        class="w-full p-3 mt-2 rounded-lg bg-gray-50 dark:bg-gray-800 border border-indigo-300 dark:border-indigo-600 text-black dark:text-white focus:ring-2 focus:ring-indigo-500 shadow-sm">
                        <option value="">-- Selecciona un grupo --</option>
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                    @error('grupo_id')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Filtro --}}
                <div>
                    <label for="filtro" class="block font-semibold text-indigo-700 dark:text-indigo-300">Filtrar alumnos por nombre:</label>
                    <input type="text" id="filtro" placeholder="Buscar alumno..."
                        class="w-full p-3 mt-2 rounded-lg bg-gray-50 dark:bg-gray-800 border border-indigo-300 dark:border-indigo-600 text-black dark:text-white focus:ring-2 focus:ring-indigo-500 shadow-sm">
                </div>

                {{-- Lista de alumnos --}}
                <div>
                    <label class="block font-semibold text-indigo-700 dark:text-indigo-300 mb-2">Alumnos existentes:</label>
                    <div class="space-y-2 max-h-60 overflow-y-auto px-2 border rounded-lg border-indigo-200 dark:border-indigo-600 bg-gray-50 dark:bg-gray-800">
                        @foreach ($alumnos as $alumno)
                            <div class="flex items-center gap-3 alumno-item">
                                <input type="checkbox" name="alumnos[]" value="{{ $alumno->id }}" id="alumno_{{ $alumno->id }}"
                                    class="accent-indigo-600 focus:ring-indigo-500">
                                <label for="alumno_{{ $alumno->id }}" class="text-indigo-800 dark:text-indigo-100">
                                    {{ $alumno->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('alumnos')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Botón --}}
                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition shadow-md">
                        Asignar Alumnos
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Script de filtrado --}}
    <script>
        document.getElementById('filtro').addEventListener('keyup', function () {
            const valor = this.value.toLowerCase();
            const alumnos = document.querySelectorAll('.alumno-item');
            alumnos.forEach(function (alumno) {
                const nombre = alumno.textContent.toLowerCase();
                alumno.style.display = nombre.includes(valor) ? '' : 'none';
            });
        });
    </script>
</x-layouts.app>
