<?php

use Core\app\Models\Admin;
use Core\app\Models\BaseSetting;
use Core\app\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $plan = BaseSetting::firstOrCreate([
            'title' => 'plan',
            'slug' => 'plan',
        ]);

        Setting::firstOrCreate([
            'base_setting_id' => $plan->id,
            'title' => 'free_days',
            'slug' => 'free_days',
            'value' => '2'
        ]);

        Setting::firstOrCreate([
            'base_setting_id' => $plan->id,
            'title' => 'default plan',
            'slug' => 'default_plan',
            'value' => '1'
        ]);


    }
}
