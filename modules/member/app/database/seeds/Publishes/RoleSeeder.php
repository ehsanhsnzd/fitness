<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		Role::firstOrCreate([
			'name'       => 'super_admin',
			'guard_name' => 'users'
		]);
		Role::firstOrCreate([
			'name'       => 'admin',
			'guard_name' => 'users'
		]);
		Role::firstOrCreate([
			'name'       => 'agent',
			'guard_name' => 'agent'
		]);
		
	}
}
