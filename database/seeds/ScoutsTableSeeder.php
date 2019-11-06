<?php

use Illuminate\Database\Seeder;

class ScoutsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('scouts')->truncate();

        $scouts = [
            ['corp_id' => 2,
             'job_seeker_id' => 1,
             'contents' => '君から新たな野糞の息吹を感じる...。共に大きな野糞を世に解き放とう!!!!!!'],
            ['corp_id' => 2,
             'job_seeker_id' => 2,
             'contents' => '君の肛門から野糞を感じる...。共に大きな野糞を世に解き放とう!!!!!!']
        ];

        foreach($scouts as $scout) {
            \App\Scout::create($scout);
        }
    }
}
