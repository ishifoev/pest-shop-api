<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Token\Builder;
use Ramsey\Uuid\Uuid;
use Lcobucci\JWT\Signer\Key;
use Firebase\JWT\JWT;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
/*$userUuid = Uuid::uuid4()->toString();
//dd($userUuid);
$tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
$algorithm    = new Sha256();
$signingKey   = InMemory::plainText(random_bytes(32));

//$now   = new DateTimeImmutable();
try {
    $token = $tokenBuilder
    // Configures the issuer (iss claim)
    ->permittedFor(config("app.url"))
        ->identifiedBy($userUuid)
        ->issuedAt(new DateTimeImmutable())
        ->canOnlyBeUsedAfter(new DateTimeImmutable('+1 minute'))
        ->expiresAt(new DateTimeImmutable('+1 hour'))
    ->getToken($algorithm, $signingKey);

   dd($token->toString());
} catch (Exception $e) {
    // Handle the exception here
    dd($e->getMessage());
}*/


  //  return view('welcome');
});

