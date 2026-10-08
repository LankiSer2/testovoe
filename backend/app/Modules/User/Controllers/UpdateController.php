<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Actions\Update as UpdateAction;
use App\Modules\User\Dto\Read as ReadDto;
use App\Modules\User\Dto\Update as UpdateDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __construct(
        private readonly UpdateAction $action,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $dto = UpdateDto::fromRequest($request);
        $user = $this->action->execute($request->user(), $dto);

        return response()->json(ReadDto::fromModel($user)->toArray());
    }
}
