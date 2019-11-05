<?php

use Illuminate\Database\Seeder;

class JobApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('job_applications')->truncate();
        $apps = [
            ['job_offer_id' => 2,
             'job_seeker_id' => 1]
        ];
        foreach($apps as $app){
            \App\JobApplication::create($app);
        }
    }
}
