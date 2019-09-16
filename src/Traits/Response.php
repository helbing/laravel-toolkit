<?php

namespace LaravelToolkit\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

trait Response
{
    /**
     * @param array|Collection $data
     * @param integer $status
     * @param array $headers
     * @param integer $options
     * @return JsonResponse
     */
    public function response($data = [], int $status = 200, array $headers = [], int $options = 0): JsonResponse
    {
        return response()->json($data, $status, $headers, $options);
    }

    /**
     * @param LengthAwarePaginator $paginator
     * @param int $status
     * @param array $headers
     * @param integer $options
     * @return JsonResponse
     */
    public function paginate(LengthAwarePaginator $paginator, int $status = 200, array $headers = [], int $options = 0): JsonResponse
    {
        $data = [
            'data' => $paginator->getCollection(),
            'pagination' => [
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'previous_url' => $paginator->previousPageUrl(),
                'next_url' => $paginator->nextPageUrl()
            ]
        ];

        return response()->json($data, $status, $headers, $options);
    }
}
