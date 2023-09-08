<?php

namespace App\Services;

use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use DateTimeImmutable;

class TokenService 
{
    public static function generateToken($userUuid)
    {
        $tokenBuilder = (new Builder(new JoseEncoder(), ChainedFormatter::default()));
        $algorithm    = new Sha256();
        $signingKey   = InMemory::plainText(random_bytes(32));
        // dd($signingKey);
        $tokenBuilder
        // Configures the issuer (iss claim)
        ->permittedFor(config("app.url"))
            ->identifiedBy($userUuid)
            ->issuedAt(new DateTimeImmutable())
            ->canOnlyBeUsedAfter(new DateTimeImmutable('+1 minute'))
            ->expiresAt(new DateTimeImmutable('+1 hour'))
        ->getToken($algorithm, $signingKey);

        return $tokenBuilder->getToken($algorithm, $signingKey)->toString();
    }
}