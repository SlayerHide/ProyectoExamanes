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
       $admin = Role::firstOrCreate(['name' => 'admin']);
    $docente = Role::firstOrCreate(['name' => 'docente']);
    $alumno = Role::firstOrCreate(['name' => 'alumno']);

    Permission::firstOrCreate(['name' => 'crear examen']);
    Permission::firstOrCreate(['name' => 'contestar examen']);
    Permission::firstOrCreate(['name' => 'ver resultados']);
    Permission::firstOrCreate(['name' => 'gestionar usuarios']);

    $admin->givePermissionTo(Permission::all());
    $docente->givePermissionTo(['crear examen', 'ver resultados']);
    $alumno->givePermissionTo(['contestar examen']);

    $user = \App\Models\User::find(1);
    $user?->assignRole('admin');
    }
}
