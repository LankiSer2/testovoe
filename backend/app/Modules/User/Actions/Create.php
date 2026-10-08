<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Dto\Create as CreateDto;
use App\Modules\User\Services\Create as CreateService;

final class Create
{
    public function __construct(
        private readonly CreateService $service,
    ) {
    }

    public function execute(CreateDto $dto): array
    {
        return $this->service->handle($dto);
    }
}
