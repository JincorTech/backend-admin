<?php

namespace App\Extensions;

use App\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use JincorTech\AuthClient\AuthServiceInterface;

class AccessTokenGuard implements Guard
{

    /**
     * @var AuthServiceInterface
     */
    private $authService;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var string
     */
    private $token;

    /**
     * AccessTokenGuard constructor.
     *
     * @param Request $request
     * @param AuthServiceInterface $authService
     */
    public function __construct(Request $request, AuthServiceInterface $authService)
    {
        $this->authService = $authService;
        $this->request = $request;
    }

    /**
     * Determine if the current user is authenticated.
     *
     * @return bool
     */
    public function check()
    {
        $token = $this->tokenForRequest();
        if ($token && $this->authService->verifyUserToken($token, config('jincor-auth.jwt'))->getScope() === 'jincor-admin') {
            return true;
        }

        return false;
    }

    public function guest()
    {
        if (!$this->tokenForRequest()) {
            return true;
        }

        return false;
    }

    public function logout()
    {
        $token = $this->tokenForRequest();
        $this->authService->logoutUser($token, config('jincor-auth.jwt'));
        Cookie::queue(Cookie::forget('token'));
        return redirect('/login');
    }

    public function attempt(array $credentials)
    {
        try {
            $this->token = $this->authService->loginUser([
                'login' => $credentials['email'],
                'password' => $credentials['password'],
                'deviceId' => '777'
            ], config('jincor-auth.jwt'));

            Cookie::queue(cookie('token', $this->token));

            return true;

        } catch (Exception $e) {
        }

        return false;
    }

    public function authenticate()
    {
        if ($this->tokenForRequest()) {
            $this->authService->verifyUserToken($this->tokenForRequest(), config('jincor-auth.jwt'));
            return true;
        }

        return false;
    }

    /**
     * Get the currently authenticated user.
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function user()
    {
        $token = $this->tokenForRequest() ? $this->tokenForRequest() : $this->token;
        $data = $this->authService->verifyUserToken($token, config('jincor-auth.jwt'));

        $user = new User();
        $user->setAttribute('name', $data->getLogin());
        $user->setCreatedAt($data->getIat());

        return $user;
    }

    /**
     * Get the ID for the currently authenticated user.
     *
     * @return int|null
     */
    public function id()
    {
        return null;
    }

    /**
     * Validate a user's credentials.
     *
     * @param  array $credentials
     * @return bool
     */
    public function validate(array $credentials = [])
    {
        return array_key_exists('email', $credentials) && array_key_exists('password', $credentials);
    }

    /**
     * Set the current user.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable $user
     * @return void
     */
    public function setUser(Authenticatable $user)
    {
    }


    private function tokenForRequest()
    {
        $token = $this->request->cookie('token');

        if (empty($token)) {
            $token = $this->request->bearerToken();
        }

        return $token;
    }
}
