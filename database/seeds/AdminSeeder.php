<?php

use Illuminate\Database\Seeder;
use App\User;

class AdminSeeder extends Seeder
{
    /**
     * Seed admin user
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        if (User::where('email', '=', 'admin@jincor.com')->exists()) {
            throw new \Exception('Admin user already exists!');
        }

        $password = $this->generateRandomString();
        User::create([
            'name' => 'Jincor Admin',
            'email' => 'admin@jincor.com',
            'password' => bcrypt($password),
        ]);

        echo 'Admin password:' . $password . "\n";
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-=+';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
