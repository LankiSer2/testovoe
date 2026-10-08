<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\Update as UpdateDto;
use App\Modules\User\Models\User;

final class Update
{
    public function handle(User $user, UpdateDto $dto): User
    {
        $user->fill($dto->toArray());
        $user->save();

        return $user->refresh();
    }
}
