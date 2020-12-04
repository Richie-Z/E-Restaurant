<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->admin();
        $this->user();
    }
    public function admin()
    {
        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@rumahmakan.com';
        $user->password = bcrypt('admin123');
        $user->role = 'admin';
        $user->save();
    }
    public function user()
    {
        $user = new User;
        for ($i = 1; $i < 11; $i++) {
            User::create([
                'name' => 'Meja ' . $i,
                'email' => 'meja' . $i . '@rumahmakan.com',
                'password' => bcrypt('meja' . $i),
            ]);
        }
    }
}
