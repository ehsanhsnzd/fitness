<?php

use Core\app\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		Admin::firstOrCreate([
			'name'       => 'admin',
			'email'      => 'admin@admin.admin',
            'password'   => '$2y$10$cGZ.YzRSP9WOSgSaMevIh.bdkQGeEmxfze6SNwclTFnF2BVOnM/Tu'
		]);

	}
}
