<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\User\Actions\Create as CreateAction;
use App\Modules\User\Dto\Create as CreateDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

#[OA\Tag(name: 'User', description: 'User registration and profile')]
class CreateController extends Controller
{
    public function __construct(
        private readonly CreateAction $action,
    ) {
    }

    #[OA\Post(
        path: '/api/registration',
        operationId: 'registerUser',
        summary: 'Register a new user',
        tags: ['User'],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ['email', 'password', 'gender'],
                properties: [
                    new OA\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
                    new OA\Property(property: 'password', type: 'string', minLength: 8, example: 'password123'),
                    new OA\Property(property: 'gender', type: 'string', enum: ['male', 'female', 'other'], example: 'male'),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'User registered successfully',
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property: 'user',
                            properties: [
                                new OA\Property(property: 'id', type: 'integer', example: 1),
                                new OA\Property(property: 'email', type: 'string', example: 'user@example.com'),
                                new OA\Property(property: 'gender', type: 'string', example: 'male'),
                                new OA\Property(property: 'created_at', type: 'string', format: 'date-time'),
                            ],
                            type: 'object'
                        ),
                        new OA\Property(property: 'token', type: 'string', example: '1|xxxxxxxx'),
                        new OA\Property(property: 'token_type', type: 'string', example: 'Bearer'),
                    ]
                )
            ),
            new OA\Response(response: 422, description: 'Validation error'),
        ]
    )]
    public function __invoke(Request $request): JsonResponse
    {
        $dto = CreateDto::fromRequest($request);
        $result = $this->action->execute($dto);

        return response()->json($result, 201);
    }
}
