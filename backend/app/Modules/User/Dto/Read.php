<?php

namespace App\Modules\User\Dto;

use App\Modules\User\Models\User;

final class Read
{
    public function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly string $gender,
        public readonly ?string $createdAt,
    ) {
    }

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            email: $user->email,
            gender: $user->gender,
            createdAt: $user->created_at?->toIso8601String(),
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'gender' => $this->gender,
            'created_at' => $this->createdAt,
        ];
    }
}
