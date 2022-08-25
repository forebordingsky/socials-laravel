<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $faker = \Faker\Factory::create();

        User::create([
            'email' => 'test@test.ru',
            'password' => 'password'
        ]);

        User::create([
            'email' => 'test2@test.ru',
            'password' => 'password'
        ]);

        User::create([
            'email' => 'test3@test.ru',
            'password' => 'password'
        ]);

        Comment::create([
            'user_id' => 1,
            'header' => $faker->text(rand(6,20)),
            'description' => $faker->text(rand(20,30)),

        ]);

        Comment::create([
            'user_id' => 1,
            'header' => $faker->text(rand(6,20)),
            'description' => $faker->text(rand(20,30)),
        ]);

        Comment::create([
            'user_id' => 2,
            'parent_id' => 1,
            'header' => $faker->text(rand(6,20)),
            'description' => $faker->text(rand(20,30)),
        ]);

        Comment::create([
            'user_id' => 2,
            'header' => $faker->text(rand(6,20)),
            'description' => $faker->text(rand(20,30)),
        ]);

        Comment::create([
            'user_id' => 3,
            'header' => $faker->text(rand(6,20)),
            'description' => $faker->text(rand(20,30)),
        ]);

        Book::create([
            'user_id' => 1,
            'name' => $faker->text(rand(6,20)),
            'content' => $faker->text(rand(50,100))
        ]);
        Book::create([
            'user_id' => 1,
            'name' => $faker->text(rand(6,20)),
            'content' => $faker->text(rand(50,100))
        ]);
        Book::create([
            'user_id' => 2,
            'name' => $faker->text(rand(6,20)),
            'content' => $faker->text(rand(50,100))
        ]);

        //Дать доступ второму пользователю к библиотеке первого
        DB::table('shared_library')->insert([
            'owner_id' => 1,
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
