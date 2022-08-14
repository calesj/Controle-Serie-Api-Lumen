<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;


class Autenticador
{
    public function handle(Request $request, Closure $next)
    {
        try {
            //Se na requisição, não existir o cabeçalho "Authorization" retornará um erro
            if (!$request->hasHeader('Authorization')) {
                throw new \Exception();
            }
            //Se existir o cabeçalho "Authorization", ele retirará a palavra "Bearer ", deixando apenas o token puro
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ', '', $authorizationHeader);

            //Após, ele tentará decodificar o token retornado
            //caso o token seja inválido, cairá no catch, automaticamente
            $dadosAutenticacao = JWT::decode($token, new Key(env('JWT_KEY'), 'HS256'));

            //Se o token for valido, ele tentará buscar o usuario no banco de dados
            //se não econtrar, cairá no catch automaticamente
            $user = User::where('email', $dadosAutenticacao->email)
                ->first();
            if (is_null(($user))) {
                throw new \Exception();
            }
            return $next($request);
        } catch (\Exception $e) {
            return response()->json('Não Autorizado',401);
          }
    }
}
