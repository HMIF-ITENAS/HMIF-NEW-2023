<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function ($user) {
            if ($user->level === 'admin') {
                $user->posts()->saveMany(factory(App\Post::class, mt_rand(2, 5))->make());
            }
        });
    }
}
