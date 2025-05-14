<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Seeds\Facedes\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles (o usar existentes)
        $administrador = Role::firstOrCreate(['name' => 'administrador']);
        $docente = Role::firstOrCreate(['name' => 'docente']);
        $alumno = Role::firstOrCreate(['name' => 'alumno']);

        // Crear permisos (o usar existentes)
        $asignarGrupo = Permission::firstOrCreate(['name' => 'asignar grupo']);
        $asignarRol = Permission::firstOrCreate(['name' => 'asignar rol']);
        $asignarAlumno = Permission::firstOrCreate(['name' => 'asignar alumno']);
        $crearExamen = Permission::firstOrCreate(['name' => 'crear examen']);
        $contestarExamen = Permission::firstOrCreate(['name' => 'contestar examen']);

        // Asignar permisos a roles (sin duplicar)
        $administrador->givePermissionTo([$asignarGrupo, $asignarRol, $asignarAlumno]);
        $docente->givePermissionTo($crearExamen);
        $alumno->givePermissionTo($contestarExamen);

        // Crear usuarios si no existen (para evitar duplicados)
        $u1 = User::firstOrCreate(
            ['email' => 'cl2726933@gmail.com'],
            ['name' => 'Cynthia Angelica De Luna Ortega', 'password' => bcrypt('Cadlo3705')]
        );

        $u2 = User::firstOrCreate(
            ['email' => 'dloangelica23@gmail.com'],
            ['name' => 'Axel Saucedo Palos', 'password' => bcrypt('cynthia0523')]
        );

        $u3 = User::firstOrCreate(
            ['email' => '19progcadlo@gmail.com'],
            ['name' => 'Mireya Valeria De Luna Ortega', 'password' => bcrypt('Valeria0923')]
        );

        // Asignar roles a usuarios
        $u1->assignRole('administrador');
        $u2->assignRole('docente');
        $u3->assignRole('alumno');
    }
}
