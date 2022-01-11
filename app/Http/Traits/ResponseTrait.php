<?php

namespace App\Http\Traits;

use Illuminate\Http\Response;
use Throwable;

trait ResponseTrait
{
    /**
     * Handle all success responses
     *
     * @param mixed $data
     * @param array $extra
     * @param int $status
     * @return Response
     */
    public function successResponse(mixed $data, array $extra = [], int $status = 200): Response
    {
        return response(['value' => $data, 'extra' => $extra], $status);
    }

    /**
     * Handle all success responses
     *
     * @param string $message
     * @param Throwable|null $exception
     * @param int $status
     * @param array $extra
     * @return Response
     */
    public function errorResponse(string $message, Throwable $exception = null, int $status = 500, array $extra = []): Response
    {
        return response(['error' => true, 'msg' => $message, 'extra' => array_merge_recursive(['message' => $exception?->getMessage(),
            'state' => $exception?->getCode()], $extra)], $status);
    }
}
