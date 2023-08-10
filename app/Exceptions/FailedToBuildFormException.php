<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class FailedToBuildFormException extends Exception
{
    /**
     * Report the exception.
     */
    public function report(): void
    {
        Log::error('Failed to build form', [
            'message' => $this->getMessage(),
            'trace' => $this->getTrace(),
        ]);
    }

    /**
     * Render the exception as an JSON response.
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json([
            'message' => 'Failed to build form.',
        ], 500);
    }
}
