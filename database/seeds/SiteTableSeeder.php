<?php

use Illuminate\Database\Seeder;

class SiteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $site = new \Fb\Models\Site();
        $site->title = 'FB Shop';
        $site->save();
    }
}
