<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\Create as CreateDto;
use App\Modules\User\Models\User;

final class Create
{
    public function handle(CreateDto $dto): array
    {
        $user = User::query()->create($dto->toArray());

        $token = $user->createToken('registration')->plainTextToken;

        return [
            'user' => [
                'id' => $user->id,
                'email' => $user->email,
                'gender' => $user->gender,
                'created_at' => $user->created_at?->toIso8601String(),
            ],
            'token' => $token,
            'token_type' => 'Bearer',
        ];
    }
}
