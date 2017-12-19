<?php

use Illuminate\Database\Seeder;
use JincorTech\AuthClient\AuthServiceInterface;

class AdminSeeder extends Seeder
{

    /**
     * @var AuthServiceInterface
     */
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Seed admin user
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $password = $this->generateRandomString();

        $this->authService->createUser([
            'email' => 'admin@jincor.com',
            'login' => 'admin@jincor.com',
            'password' => $password,
            'sub' => 'Jincor',
            'scope' => 'jincor-admin'],
            config('jincor-auth.jwt')
        );

        echo 'Admin password:' . $password . "\n";
    }

    protected function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_-=+';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
