<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \App\Article::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        \App\Article::unguard();

        $faker = \Faker\Factory::create();

        \App\User::all()->each(function ($user) use ($faker) {
            foreach(range(1, 5) as $i) {
                \App\Article::create([
                    'user_id' => $user->id,
                    'title' => $faker->sentence,
                    'content' => $faker->paragraph(3, true),
                ]);
            }
        });
    }
}
