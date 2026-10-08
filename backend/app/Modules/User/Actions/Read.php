<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Models\User;
use App\Modules\User\Services\Read as ReadService;

final class Read
{
    public function __construct(
        private readonly ReadService $service,
    ) {
    }

    public function execute(User $user): array
    {
        return $this->service->handle($user);
    }
}
