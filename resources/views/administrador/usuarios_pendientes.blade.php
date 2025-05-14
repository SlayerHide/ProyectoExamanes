<x-layouts.app title="Usuarios Pendientes">
    <div class="flex flex-col items-center justify-center min-h-screen p-6 bg-pink-100 dark:bg-pink-900">
        <!-- Título -->
        <div class="w-full max-w-4xl bg-pink-50 dark:bg-pink-800 shadow-lg rounded-xl p-6 border border-pink-200 dark:border-pink-700">
            <h1 class="text-2xl font-bold text-center text-pink-800 dark:text-pink-200">Usuarios pendientes de aprobación</h1>

            @if (session('status'))
            <div class="mt-4 bg-green-200 text-green-900 px-4 py-3 rounded">
                {{ session('status') }}
            </div>
            @endif

            @if ($usuariosPendientes->isEmpty())
            <p class="mt-6 text-center text-pink-700 dark:text-pink-300">No hay usuarios pendientes por aprobar.</p>
            @else
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-xl shadow-md">
                    <thead>
                        <tr class="bg-pink-200 dark:bg-pink-700 text-left text-pink-900 dark:text-pink-100">
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Correo</th>
                            <th class="px-6 py-3">Rol solicitado</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuariosPendientes as $user)
                        <tr class="border-t border-pink-300 dark:border-pink-600 text-gray-700 dark:text-gray-100">
                            <td class="px-6 py-3">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3 capitalize">{{ $user->requested_role }}</td>
                            <td class="px-6 py-3 flex gap-2">
                                <form action="{{ route('administrador.aprobar', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                        Aprobar
                                    </button>
                                </form>
                                <form action="{{ route('administrador.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
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