<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class SwaggerController extends Controller
{
    public function index(): BinaryFileResponse|JsonResponse
    {
        $path = public_path('swagger/openapi.yaml');

        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        return response()->file($path);
    }
}
