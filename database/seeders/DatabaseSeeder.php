<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $usuario=User::factory()->create([
            'nombre' => 'Gilbert Jesus',
            'apellido' => 'Martinez Grados',
            'password' => bcrypt('12345678'),
            'email' => 'admin@gmail.com',
        ]);

        $adminRole=Role::create([
            'name' => 'admin',
        ]);

        Role::create([
            'name' => 'docente',
        ]);
        Role::create([
            'name' => 'alumno',
        ]);

        $usuario->assignRole($adminRole);
    }
}
