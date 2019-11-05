<?php

use Illuminate\Database\Seeder;

class JobOffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('job_offers')->truncate();
        $offers = [
            ['corp_id' => 1,
             'title' => '株式会社うんち SE募集',
             'presentation_annual_income' => 3000000,
             'work_location' => '東京都',
             'occupation' => 'SE',
             'contents' => '職場の雰囲気:アットホームで風通しの良い職場です！'],
            ['corp_id' => 1,
             'title' => '株式会社うんち PG募集',
             'presentation_annual_income' => 4000000,
             'work_location' => '神奈川県',
             'occupation' => 'PG',
             'contents' => '職場の雰囲気:アットホームで風通しの良い職場です！ブラック企業ではありません。']
        ];
        foreach($offers as $offer){
            \App\JobOffer::create($offer);
        }
    }
}
