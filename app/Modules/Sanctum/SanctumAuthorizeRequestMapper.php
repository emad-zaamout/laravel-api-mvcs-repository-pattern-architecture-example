<?php

declare(strict_types=1);

namespace App\Modules\Sanctum;

class SanctumAuthorizeRequestMapper
{
    public static function mapFrom(array $data) : SanctumAuthorizeRequest
    {
        return new SanctumAuthorizeRequest(
            $data["email"],
            $data["password"],
            $data["device"],
        );
    }
}
