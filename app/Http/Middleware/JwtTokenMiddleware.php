<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;
use Lcobucci\JWT\Token\Parser;
use Lcobucci\JWT\Validation\Validator;
use Lcobucci\JWT\Validation\Constraint\RelatedTo;
use Lcobucci\JWT\Exception\RequiredConstraintsViolated;

use Lcobucci\JWT\Encoding\JoseEncoder;

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
        //dd($token);

        if (!$token) {
            return response()->json(['message' => 'Unauthorizedqwq'], 401);
        }

        try {
            //$validator = new Validator();
            $parseToken = (new Parser(new JoseEncoder()))->parse($token);
            $jti = $parseToken->claims()->get('jti');
            //dd($jti);

            $expectedJti = "3313a5ff-4c15-4e8d-86a8-28cf2a6564e7";

            if ($jti !== $expectedJti) {
                return response()->json(['message' => 'Invalid token'], 401);
            }

            //return response()->json(['jti' => $jw]);
           
            //$validator->assert($parseToken, new RelatedTo('1234567891'));
            //dd($test);
    
            return $next($request);
        } catch (Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
