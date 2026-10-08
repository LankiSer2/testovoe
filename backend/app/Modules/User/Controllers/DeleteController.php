<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Actions\Delete as DeleteAction;
use App\Modules\User\Dto\Delete as DeleteDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __construct(
        private readonly DeleteAction $action,
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $this->action->execute(DeleteDto::fromId($request->user()->id));

        return response()->json(['message' => 'User deleted successfully']);
    }
}
