<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SeederTablePermisos extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $persmisos = [
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'borrar-rol',

            'ver-coach',
            'crear-coach',
            'editar-coach',
            'borrar-coach'
        ];

        foreach ($permisos as $permiso) {
            Permission::create(['name'=>$permiso]);
        }
    }
}
