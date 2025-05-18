<x-layouts.app title="Editar Usuario">
    <div class="p-6 max-w-lg mx-auto">
        <h1 class="text-2xl font-bold mb-4 text-purple-800">Editar usuario</h1>

        <form action="{{ route('administrador.usuarios.actualizar', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block font-semibold mb-1">Nombre:</label>
                <input type="text" name="name" class="w-full border p-2" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Correo:</label>
                <input type="email" name="email" class="w-full border p-2" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Rol:</label>
                <select name="role" class="w-full border p-2" required>
                    <option value="admin" {{ $user->rol === 'admin' ? 'selected' : '' }}>Administrador</option>
                    <option value="docente" {{ $user->rol === 'docente' ? 'selected' : '' }}>Docente</option>
                    <option value="alumno" {{ $user->rol === 'alumno' ? 'selected' : '' }}>Alumno</option>
                </select>
            </div>

            <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                Guardar cambios
            </button>
        </form>
    </div>
</x-layouts.app>
