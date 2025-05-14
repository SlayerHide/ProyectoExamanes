<x-layouts.app title="Mis Exámenes">
    <div class="p-6">
        <h1 class="text-2xl font-bold mb-4">Exámenes Creados</h1>

        @if(session('status'))
            <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">{{ session('status') }}</div>
        @endif

        <a href="{{ route('docente.examenes.crear') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Crear nuevo examen</a>

        <table class="w-full border border-gray-300 text-left">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Título</th>
                    <th class="p-2">Grupo</th>
                    <th class="p-2">Duración</th>
                    <th class="p-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($examenes as $examen)
                    <tr class="border-t">
                        <td class="p-2">{{ $examen->titulo }}</td>
                        <td class="p-2">{{ $examen->grupoMateria->nombre ?? 'Sin grupo' }}</td>
                        <td class="p-2">{{ $examen->duracion }} min</td>
                        <td class="p-2">
                            <a href="{{ route('docente.examenes.editar', $examen->id) }}" class="text-blue-600 hover:underline">Editar</a> |
                            <form method="POST" action="{{ route('docente.examenes.eliminar', $examen->id) }}" class="inline" onsubmit="return confirm('¿Eliminar este examen?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layouts.app>
