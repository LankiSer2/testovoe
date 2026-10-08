<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\Delete as DeleteDto;
use App\Modules\User\Models\User;

final class Delete
{
    public function handle(DeleteDto $dto): bool
    {
        $user = User::query()->findOrFail($dto->id);

        return (bool) $user->delete();
    }
}
