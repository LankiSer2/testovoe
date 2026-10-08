<?php

namespace App\Modules\User\Dto;

use Illuminate\Http\Request;

final class Create
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly string $gender,
    ) {
    }

    public static function fromRequest(Request $request): self
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => ['required', 'string', 'in:male,female,other'],
        ]);

        return new self(
            email: $validated['email'],
            password: $validated['password'],
            gender: $validated['gender'],
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
            'gender' => $this->gender,
        ];
    }
}
