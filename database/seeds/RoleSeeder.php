<?php

use Core\app\Models\Admin;
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

		/*app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
		Role::firstOrCreate([
			'name'       => 'premium',
			'guard_name' => 'users'
		]);
		Role::firstOrCreate([
			'name'       => 'gold',
			'guard_name' => 'users'
		]);
		Role::firstOrCreate([
			'name'       => 'unlimited',
			'guard_name' => 'users'
		]);*/

	}
}
