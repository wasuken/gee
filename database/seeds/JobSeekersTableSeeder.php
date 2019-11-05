<?php

use Illuminate\Database\Seeder;

class JobSeekersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('job_seekers')->truncate();
        $seekers = [
            ['user_id' => 1]
        ];
        foreach($seekers as $seeker){
            \App\JobSeeker::create($seeker);
        }
    }
}
