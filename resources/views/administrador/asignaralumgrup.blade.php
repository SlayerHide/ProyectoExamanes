<x-layouts.app title="Asignar Alumnos a Grupo">
    <div class="flex flex-col items-center justify-center min-h-screen p-6 bg-purple-100 dark:bg-purple-900">
        <div class="w-full max-w-3xl bg-white dark:bg-gray-800 shadow-lg rounded-xl p-6 border border-gray-200 dark:border-gray-700">
            <h2 class="text-2xl font-bold text-center text-purple-800 dark:text-purple-200">Asignar Alumnos a Grupo</h2>

            @if(session('success'))
            <div class="mt-4 bg-green-200 text-green-900 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            {{-- Formulario para asignar alumnos --}}
            <form method="POST" action="{{ route('grupos.asignarAlumnos') }}" class="mt-6">
                @csrf

                {{-- Selector de grupo --}}
                <div class="form-group mb-4">
                    <label for="grupo_id" class="block text-purple-700 dark:text-purple-300 font-semibold">Seleccionar grupo:</label>
                    <select name="grupo_id" id="grupo_id" class="w-full p-3 mt-2 rounded-lg border border-purple-300 focus:ring-2 focus:ring-purple-500" required>
                        <option value="">-- Selecciona un grupo --</option>
                        @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                        @endforeach
                    </select>
                    @error('grupo_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    </select>
                </div>

                {{-- Filtro de búsqueda --}}
                <div class="form-group mb-4">
                    <label for="filtro" class="block text-purple-700 dark:text-purple-300 font-semibold">Filtrar alumnos por nombre:</label>
                    <input type="text" id="filtro" placeholder="Buscar alumno..." class="w-full p-3 mt-2 rounded-lg border border-purple-300 focus:ring-2 focus:ring-purple-500">
                </div>

                {{-- Lista de alumnos --}}
                <label class="block text-purple-700 dark:text-purple-300 font-semibold">Alumnos existentes</label>
                <div class="form-group" style="max-height: 300px; overflow-y: auto;">
                    @foreach ($alumnos as $alumno)
                    <div class="form-check alumno-item flex items-center space-x-3 py-1">
                        <input class="form-check-input" type="checkbox" name="alumnos[]" value="{{ $alumno->id }}" id="alumno_{{ $alumno->id }}">
                        <label class="form-check-label text-purple-800 dark:text-purple-200" for="alumno_{{ $alumno->id }}">
                            {{ $alumno->name }}
                        </label>
                    </div>
                    @endforeach
                    @error('alumnos')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="mt-6 w-full bg-purple-500 text-white p-3 rounded-lg shadow-md hover:bg-purple-600 transition">
                    Asignar Alumnos
                </button>
            </form>
        </div>
    </div>

    {{-- Script para filtrar alumnos --}}
    <script>
        document.getElementById('filtro').addEventListener('keyup', function() {
            var valor = this.value.toLowerCase();
            var alumnos = document.querySelectorAll('.alumno-item');

            alumnos.forEach(function(alumno) {
                var nombre = alumno.textContent.toLowerCase();
                alumno.style.display = nombre.includes(valor) ? '' : 'none';
            });
        });
    </script>
</x-layouts.app>