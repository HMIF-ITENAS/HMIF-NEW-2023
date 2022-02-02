<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create([
            'name' => "Admin HMIF",
            'email' => "hmif@itenas.ac.id",
            'nrp' => "152018001",
            'angkatan' => "2018",
            'status' => 'active',
            'level' => 'admin',
            'password' => Hash::make("hmifitenas"),
        ]);
        // factory(App\User::class, 10)->create()->each(function ($user) {
        //     if ($user->level === 'admin') {
        //         $user->posts()->saveMany(factory(App\Post::class, mt_rand(2, 5))->make());
        //     }
        // });
    }
}
