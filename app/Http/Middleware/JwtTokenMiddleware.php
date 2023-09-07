<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class JwtTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        try {
            $token = (new Parser())->parse($token);

            $data = new ValidationData();
            $data->setIssuer('your_domain'); // Set your issuer here
            $data->setAudience('your_domain'); // Set your audience here

            if (!$token->validate($data) || !$token->verify(new Sha256(), new Key('your_secret_key'))) {
                throw new Exception('Invalid token');
            }

            // You can access the user_uuid claim like this:
            $userUuid = $token->getClaim('user_uuid');

            // Attach the user_uuid to the request for future use if needed
            $request->merge(['user_uuid' => $userUuid]);

            return $next($request);
        } catch (Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
