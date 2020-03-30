<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @author Níkolas Timóteo <nikolas@nikolastps.hotmail.com>
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'view-phone', 'display_name' => 'Visualizar Telefone']);
        Permission::create(['name' => 'edit-phone', 'display_name' => 'Editar Telefone']);
        Permission::create(['name' => 'delete-phone', 'display_name' => 'Excluir Telefone']);
        Permission::create(['name' => 'view-log', 'display_name' => 'Visualizar Log']);
    }
}
