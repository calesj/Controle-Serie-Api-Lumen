<?php

namespace App\Providers;

use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Auth\GenericUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\DocBlock\Tags\Generic;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // Here you may define how you wish users to be authenticated for your Lumen
        // application. The callback which receives the incoming request instance
        // should return either a User instance or null. You're free to obtain
        // the User instance via an API token or any other method necessary.

        $this->app['auth']->viaRequest('api', function (Request $request) {
            //Se na requisição, não existir o cabeçalho "Authorization" retornará null
            if (!$request->hasHeader('Authorization')) {
                return null;
            }
            //Se existir o cabeçalho "Authorization", ele retirará a palavra "Bearer ", deixando apenas o token puro
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);

            //Após, ele tentará decodificar o token retornado
            $dadosAutenticacao = JWT::decode($token, new Key(env('JWT_KEY'), 'HS256'));

            return User::where('email', $dadosAutenticacao->email)
                ->first();
        });
    }
}
