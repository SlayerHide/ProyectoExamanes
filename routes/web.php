<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\GrupoMateriaController;
use App\Http\Controllers\ExamenDocenteController;
use App\Http\Middleware\RedirectIfAuthenticatedByRole;
use Livewire\Volt\Volt;
use App\Http\Controllers\ExamenAlumnoController;

// Ruta pública
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación
Route::get('/login', fn() => view('auth.login'))->middleware(RedirectIfAuthenticatedByRole::class);
Route::get('/register', fn() => view('auth.register'))->middleware(RedirectIfAuthenticatedByRole::class);

// Rutas comunes para usuarios autenticados
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

/*
|--------------------------------------------------------------------------
| RUTAS PARA ADMINISTRADOR
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:administrador'])->group(function () {

    // Dashboard del administrador
    Route::get('/dashboard/administrador', [AdministradorController::class, 'index'])
        ->name('dashboard.administrador');

    // Gestión de usuarios pendientes
    Route::middleware('permission:asignar rol')->group(function () {
        Route::get('/administrador/usuarios-pendientes', [AdministradorController::class, 'usuariosPendientes'])->name('administrador.usuarios_pendientes');
        Route::post('/administrador/usuarios/{user}/aprobar', [AdministradorController::class, 'aprobarUsuario'])->name('administrador.aprobar');
        Route::delete('/administrador/usuarios/{user}', [AdministradorController::class, 'destroy'])->name('administrador.destroy');
    });

    // Asignar grupos
    Route::middleware('permission:asignar grupo')->group(function () {
        Route::get('/asignar-grupo', [GrupoMateriaController::class, 'create'])->name('administrador.asignargrupo');
        Route::post('/asignar-grupo', [GrupoMateriaController::class, 'store'])->name('administrador.asignargrupo.store');
    });

    // Asignar alumnos a grupos
    Route::middleware('permission:asignar alumno')->group(function () {
        Route::get('/grupos/asignar-alumnos-a-grupo', [GrupoMateriaController::class, 'mostrarFormularioAsignarAlumnos'])->name('grupos.asignaralumnos');
        Route::post('/grupos/asignar-alumnos-a-grupo', [GrupoMateriaController::class, 'asignarAlumnos'])->name('grupos.asignarAlumnos');
    });
});


/*
|--------------------------------------------------------------------------
| RUTAS PARA DOCENTE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:docente'])->group(function () {

    // Dashboard del docente
    Route::get('/dashboard/docente', [DocenteController::class, 'index'])
        ->name('dashboard.docente');

    // Crear y guardar examen
    Route::middleware('permission:crear examen')->group(function () {
        Route::get('/docente/examenes/crear', [ExamenDocenteController::class, 'crear'])->name('docente.examenes.crear');
        Route::post('/docente/examenes/guardar', [ExamenDocenteController::class, 'guardar'])->name('docente.examenes.guardar');
    });

    Route::get('/docente/resultados', [ExamenDocenteController::class, 'resultados'])
    ->name('docente.resultados');


    Route::middleware(['auth', 'role:docente', 'permission:crear examen'])->group(function () {
    Route::get('/docente/examenes', [ExamenDocenteController::class, 'index'])->name('docente.examenes.index');
    Route::get('/docente/examenes/crear', [ExamenDocenteController::class, 'crear'])->name('docente.examenes.crear');
    Route::post('/docente/examenes/guardar', [ExamenDocenteController::class, 'guardar'])->name('docente.examenes.guardar');
    Route::get('/docente/examenes/{id}/editar', [ExamenDocenteController::class, 'editar'])->name('docente.examenes.editar');
    Route::put('/docente/examenes/{id}', [ExamenDocenteController::class, 'actualizar'])->name('docente.examenes.actualizar');
    Route::delete('/docente/examenes/{id}', [ExamenDocenteController::class, 'eliminar'])->name('docente.examenes.eliminar');
});

});


/*
|--------------------------------------------------------------------------
| RUTAS PARA ALUMNO
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:alumno'])->group(function () {

    // Dashboard del alumno
    Route::get('/dashboard/alumno', [AlumnoController::class, 'index'])
        ->name('dashboard.alumno');

    // Contestar examen
    Route::middleware('permission:contestar examen')->group(function () {
        Route::get('/examenes/contestar', fn() => view('examenes.contestar'))->name('examenes.contestar');
    });
;

Route::middleware(['auth', 'role:alumno', 'permission:contestar examen'])->group(function () {
    Route::get('/alumno/examenes/{id}/contestar', [ExamenAlumnoController::class, 'mostrar'])
        ->name('alumno.examenes.mostrar');

    Route::post('/alumno/examenes/{id}/guardar', [ExamenAlumnoController::class, 'guardar'])
        ->name('alumno.examenes.guardar');
});
Route::get('/alumno/examenes', [ExamenAlumnoController::class, 'listar'])
    ->name('alumno.examenes.disponibles');




});


/*
|--------------------------------------------------------------------------
| Requiere Auth para algunas rutas sueltas
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Esta ruta aún no especifica a qué rol pertenece, por defecto sería cualquiera autenticado
    Route::get('/examenes/crear', fn() => view('examenes.crear'))
        ->middleware('permission:crear examen')
        ->name('examenes.crear');
});


require __DIR__ . '/auth.php';
