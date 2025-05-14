<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\GrupoMateria;

class GrupoMateriaController extends Controller
{

    public function __construct()
    {
        // Aquí colocas el middleware
        $this->middleware('permission:asignar grupo')->only(['create', 'store']);
        $this->middleware('permission:asignar alumno')->only(['asignarAlumnos', 'mostrarFormularioAsignarAlumnos']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function mostrarFormularioAsignarAlumnos()
    {
        $grupos = GrupoMateria::all();
        $alumnos = User::role('alumno')->get(); // Usando Spatie

        return view('administrador.asignaralumgrup', compact('grupos', 'alumnos'));
    }

    public function asignarAlumnos(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos_materias,id',
            'alumnos' => 'required|array',
            'alumnos.*' => 'exists:users,id',
        ]);

        $grupo = GrupoMateria::findOrFail($request->grupo_id);
        $alumnos = $request->alumnos;

        $yaAsignados = [];
        $asignadosNuevos = [];

        foreach ($alumnos as $alumno_id) {
            if ($grupo->users()->where('users.id', $alumno_id)->exists()) {
                $yaAsignados[] = $alumno_id;
            } else {
                $grupo->users()->attach($alumno_id); // usar la relación
                $asignadosNuevos[] = $alumno_id;
            }
        }

        if (count($yaAsignados) && count($asignadosNuevos)) {
            return redirect()->back()->with('success', 'Algunos alumnos ya estaban asignados. Los demás fueron agregados.');
        } elseif (count($yaAsignados)) {
            return redirect()->back()->with('success', 'Todos los alumnos seleccionados ya están asignados a este grupo.');
        } else {
            return redirect()->back()->with('success', 'Alumnos asignados correctamente.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $docentes = User::role('docente')->get(); // Spatie
        return view('administrador.asignargrupo', compact('docentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:grupos_materias,nombre',
            'materia' => 'required|string',
            'docente_id' => 'required|exists:users,id',
        ], [
            'nombre.unique' => 'Ya existe un registro con ese grupo.',
        ]);

        GrupoMateria::create($request->only('nombre', 'materia', 'docente_id'));

        return redirect()->route('administrador.asignargrupo')->with('status', 'Grupo asignado correctamente');
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
    public function destroy(string $id)
    {
        //
    }
}
