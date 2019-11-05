<?php

use Illuminate\Database\Seeder;

class CorpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('corps')->truncate();
        $corps = [
            ['user_id' => 2]
        ];
        foreach($corps as $corp){
            \App\Corp::create($corp);
        }
    }
}
