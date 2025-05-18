<x-layouts.app title="Gestión de Usuarios">
    <div class="p-6 bg-gradient-to-br from-sky-200 to-indigo-300 min-h-screen">
        <div class="max-w-6xl mx-auto bg-white dark:bg-gray-900 shadow-xl rounded-xl p-6 border border-indigo-300 dark:border-indigo-700">
            
            <h1 class="text-3xl font-bold text-indigo-800 dark:text-indigo-300 mb-6 text-center">
                Usuarios del sistema
            </h1>

            {{-- Mensaje de éxito --}}
            @if(session('status'))
                <div class="mb-4 bg-green-100 text-green-800 p-3 rounded shadow text-center">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Filtro por rol --}}
            <form method="GET" action="{{ route('administrador.usuarios') }}" class="mb-6 flex flex-wrap justify-center items-center gap-4">
                <label class="font-semibold text-gray-700 dark:text-gray-300">Filtrar por rol:</label>
                <select name="rol" onchange="this.form.submit()"
                        class="border border-indigo-400 bg-white dark:bg-gray-800 text-black dark:text-white rounded px-4 py-2 shadow-md focus:ring focus:ring-indigo-300">
                    <option value="">-- Todos --</option>
                    <option value="admin" {{ request('rol') === 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="docente" {{ request('rol') === 'docente' ? 'selected' : '' }}>Docente</option>
                    <option value="alumno" {{ request('rol') === 'alumno' ? 'selected' : '' }}>Alumno</option>
                </select>
            </form>

            {{-- Tabla de usuarios --}}
            <div class="overflow-x-auto rounded-lg shadow border border-indigo-200 dark:border-indigo-700">
                <table class="min-w-full text-sm text-gray-800 dark:text-gray-100">
                    <thead class="bg-indigo-200 dark:bg-indigo-700 text-indigo-900 dark:text-white uppercase text-xs tracking-wider">
                        <tr>
                            <th class="p-3 text-left">Nombre</th>
                            <th class="p-3 text-left">Correo</th>
                            <th class="p-3 text-left">Rol</th>
                            <th class="p-3 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-indigo-100 dark:divide-indigo-700">
                        @foreach ($usuarios as $user)
                            <tr class="hover:bg-indigo-50 dark:hover:bg-gray-700 transition">
                                <td class="p-3 font-semibold">{{ $user->name }}</td>
                                <td class="p-3">{{ $user->email }}</td>
                                <td class="p-3 capitalize">{{ $user->rol }}</td>
                                <td class="p-3 flex gap-2">
                                    {{-- Editar --}}
                                    <a href="{{ route('administrador.usuarios.editar', $user->id) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-sky-600 text-white rounded-md shadow hover:bg-sky-700 text-sm transition">
                                         Editar
                                    </a>
                                    {{-- Eliminar --}}
                                    <form action="{{ route('administrador.usuarios.eliminar', $user->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Eliminar este usuario?')"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1.5 bg-rose-600 text-white rounded-md shadow hover:bg-rose-700 text-sm transition">
                                             Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-layouts.app>
