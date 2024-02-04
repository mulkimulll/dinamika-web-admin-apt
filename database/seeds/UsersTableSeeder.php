<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$5vXw3qFQAyEl6MVo4ds8VOL8wEdHf1vOfSgGLaXLgcYElVUndnH1.',
            // Other fields
        ]);
    }
}
