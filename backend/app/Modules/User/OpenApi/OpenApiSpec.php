<?php

namespace App\Modules\User\OpenApi;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    title: 'User Registration API',
    description: 'API for user registration and profile'
)]
#[OA\Server(url: '/', description: 'API server')]
#[OA\SecurityScheme(
    securityScheme: 'sanctum',
    type: 'http',
    scheme: 'bearer',
    bearerFormat: 'SANCTUM',
    description: 'Use the token from /api/registration response'
)]
final class OpenApiSpec
{
}
