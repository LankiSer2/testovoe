<?php

namespace App\Modules\User\Dto;

use Illuminate\Http\Request;

final class Update
{
    public function __construct(
        public readonly ?string $email = null,
        public readonly ?string $password = null,
        public readonly ?string $gender = null,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'email' => ['sometimes', 'email', 'max:255'],
            'password' => ['sometimes', 'string', 'min:8'],
            'gender' => ['sometimes', 'string', 'in:male,female,other'],
        ]);

        return new self(
            email: $validated['email'] ?? null,
            password: $validated['password'] ?? null,
            gender: $validated['gender'] ?? null,
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'email' => $this->email,
            'password' => $this->password,
            'gender' => $this->gender,
        ], static fn ($value) => $value !== null);
    }
}
