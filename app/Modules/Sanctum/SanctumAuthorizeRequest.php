<?php

declare(strict_types=1);

namespace App\Modules\Sanctum;

class SanctumAuthorizeRequest
{
    private string $email;
    private string $password;
    private string $device;

    public function __construct(
        string $email,
        string $password,
        string $device
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->device = $device;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getDevice(): string
    {
        return $this->device;
    }

}
