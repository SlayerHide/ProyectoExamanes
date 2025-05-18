<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdministradorController extends Controller
{
    public function __construct()
    {
        // Aquí colocas el middleware
        $this->middleware('permission:asignar rol')->only(['usuariosPendientes', 'aprobarUsuario', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->rol !== 'administrador') {
            abort(403, 'No tienes permisos para acceder a esta página.');
        }

        return view('dashboard.administrador');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function usuariosPendientes()
    {
        $usuariosPendientes = User::whereNull('rol')
            ->whereNotNull('requested_role')
            ->get();

        return view('administrador.usuarios_pendientes', compact('usuariosPendientes'));
    }

    public function aprobarUsuario(User $user)
    {
        $rol = $user->requested_role;

        $user->assignRole($rol); // Asigna rol en Spatie
        $user->rol = $rol;       // Guarda en la columna (opcional)
        $user->requested_role = null;
        $user->save();

        return back()->with('status', 'Usuario aprobado correctamente.');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('status', 'Usuario eliminado correctamente.');
    }


    public function usuarios(Request $request)
{
  $query = User::query();

    if ($request->filled('rol')) {
        $query->where('rol', $request->rol);
    }

    $usuarios = $query->get();

    return view('administrador.gestionUsuarios', compact('usuarios'));
}

public function editarUsuario(User $user)
{
    return view('administrador.editarUsuario', compact('user'));
}

public function actualizarUsuario(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,docente,alumno'
    ]);

    $user->update($request->only('name', 'email', 'role'));

    return redirect()->route('administrador.usuarios')->with('status', 'Usuario actualizado correctamente.');
}

public function eliminarUsuario(User $user)
{
    $user->delete();

    return redirect()->route('administrador.usuarios')->with('status', 'Usuario eliminado correctamente.');
}
}
