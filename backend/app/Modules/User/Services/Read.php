<?php

namespace App\Modules\User\Services;

use App\Modules\User\Dto\Read as ReadDto;
use App\Modules\User\Models\User;

final class Read
{
    public function handle(User $user): array
    {
        return ReadDto::fromModel($user)->toArray();
    }
}
