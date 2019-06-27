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
        \App\Models\User::query()->delete();
        \App\Models\User::create([
            'name' => 'Ezequiel',
            'email' => 'ezequiel@test.com',
            'password' => Hash::make('secret'),
            'role' => 'administrator'
        ]);
        \App\Models\User::create([
            'name' => 'Test',
            'email' => 'example@test.com',
            'password' => Hash::make('secret'),
            'role' => 'administrator'
        ]);
        factory(\App\Models\User::class, 10)->create()->each(function($u) {
            //
        });
    }
}
