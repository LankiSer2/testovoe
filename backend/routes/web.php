<?php

use Illuminate\Support\Facades\Route;

Route::get('/{any?}', function () {
    $spa = public_path('spa.html');

    if (! file_exists($spa)) {
        return response('Frontend build not found. Run frontend build and copy dist to public.', 500);
    }

    return response(file_get_contents($spa), 200)->header('Content-Type', 'text/html');
})->where('any', '^(?!api|docs).*$');
