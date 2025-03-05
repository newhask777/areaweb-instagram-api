<?php

namespace App\Services\User\Data;

use Illuminate\Support\Facades\Hash;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Data;

class RegisterUserData extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $login,
        #[Computed]
        public string $password,
    )
    {
        $this->password = Hash::make($this->password);
    }
}
