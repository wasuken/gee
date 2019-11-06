<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        $users =[
            ['name' => 'test1',
             'email' => 'test@test.com',
             'pr' => '私はテスターです。',
             'password' => Hash::make('testtest'),
             'remember_token' => str_random(10),
            ],
            ['name' => '山田武',
             'email' => 'yamada@test.com',
             'pr' => 'よろしくお願いします。',
             'password' => Hash::make('yamadatakeshi'),
             'remember_token' => str_random(10),
            ],
            ['name' => 'test2',
             'email' => 'test2@test.com',
             'pr' => '私はテスターです。',
             'password' => Hash::make('testtest'),
             'remember_token' => str_random(10),
            ],
            ['name' => '株式会社立憲野糞党',
             'email' => 'unchi@test.com',
             'pr' => '野糞に関しては日本一を誇っております。',
             'password' => Hash::make('nogusodayo'),
             'remember_token' => str_random(10),
            ]
        ];
        foreach($users as $user) {
            \App\User::create($user);
        }
    }
}
