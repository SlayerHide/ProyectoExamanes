<x-layouts.app title="Usuarios Pendientes">
    <div class="flex flex-col items-center justify-center min-h-screen p-6 bg-gradient-to-br from-rose-100 to-pink-200 dark:from-gray-900 dark:to-gray-800">
        <div class="w-full max-w-5xl bg-white dark:bg-gray-900 shadow-xl rounded-2xl p-8 border border-pink-300 dark:border-pink-800">

            {{-- Título --}}
            <h1 class="text-3xl font-extrabold text-center text-pink-700 dark:text-pink-200 mb-6 tracking-wide">
                Usuarios Pendientes de Aprobación
            </h1>

            {{-- Alertas --}}
            @if (session('status'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded shadow-sm">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Vacío --}}
            @if ($usuariosPendientes->isEmpty())
                <div class="text-center text-pink-700 dark:text-pink-300 py-10">
                    <p class="text-lg font-medium">No hay usuarios pendientes por aprobar.</p>
                </div>
            @else

            {{-- Tabla de usuarios --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-gray-800 dark:text-gray-200">
                    <thead class="bg-pink-200 dark:bg-pink-700 text-pink-900 dark:text-white uppercase text-xs tracking-wide">
                        <tr>
                            <th class="px-6 py-4 text-left">Nombre</th>
                            <th class="px-6 py-4 text-left">Correo</th>
                            <th class="px-6 py-4 text-left">Rol solicitado</th>
                            <th class="px-6 py-4 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-pink-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                        @foreach ($usuariosPendientes as $user)
                            <tr class="hover:bg-pink-50 dark:hover:bg-gray-700 transition">
                                <td class="px-6 py-3 font-semibold">{{ $user->name }}</td>
                                <td class="px-6 py-3">{{ $user->email }}</td>
                                <td class="px-6 py-3 capitalize">{{ $user->requested_role }}</td>
                                <td class="px-6 py-3 flex gap-3">
                                    {{-- Aprobar --}}
                                    <form action="{{ route('administrador.aprobar', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white font-semibold px-4 py-1.5 rounded shadow transition">
                                            Aprobar
                                        </button>
                                    </form>

                                    {{-- Eliminar --}}
                                    <form action="{{ route('administrador.usuarios.eliminar', $user) }}" method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold px-4 py-1.5 rounded shadow transition">
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif

        </div>
    </div>
</x-layouts.app>
