<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Dto\Delete as DeleteDto;
use App\Modules\User\Services\Delete as DeleteService;

final class Delete
{
    public function __construct(
        private readonly DeleteService $service,
    ) {
    }

    public function execute(DeleteDto $dto): bool
    {
        return $this->service->handle($dto);
    }
}
