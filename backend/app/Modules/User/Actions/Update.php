<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Dto\Update as UpdateDto;
use App\Modules\User\Models\User;
use App\Modules\User\Services\Update as UpdateService;

final class Update
{
    public function __construct(
        private readonly UpdateService $service,
    ) {
    }

    public function execute(User $user, UpdateDto $dto): User
    {
        return $this->service->handle($user, $dto);
    }
}
