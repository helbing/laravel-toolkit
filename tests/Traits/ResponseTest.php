<?php

namespace Tests\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Tests\TestCase;
use LaravelToolkit\Traits\Response;

class ResponseTest extends TestCase
{
    use Response;

    /**
     * @return void
     */
    public function testResponse()
    {
        /**
         * @var Collection
         */
        $data = collect([
            [
                'name' => $this->faker->name
            ],
            [
                'name' => $this->faker->name
            ]
        ]);

        $response = $this->response($data);

        /**
         * @var Collection
         */
        $result = collect($response->getData(true));

        $this->assertTrue($response->isOk());
        $this->assertEquals($data->count(), $result->count());

        $response = $this->response([], JsonResponse::HTTP_FORBIDDEN);

        $this->assertTrue($response->isForbidden());
    }

    /**
     * @return void
     */
    public function testPaginate()
    {
        /**
         * @var Collection
         */
        $data = collect([
            [
                'name' => $this->faker->name
            ],
            [
                'name' => $this->faker->name
            ]
        ]);

        $total = 100;
        $perPage = 20;
        $currentPage = 2;

        $paginate =  new LengthAwarePaginator($data, $total, $perPage, $currentPage);

        $response = $this->paginate($paginate);

        /**
         * @var Collection
         */
        $result = collect($response->getData(true));

        $this->assertTrue($response->isOk());
        $this->assertEquals($data->count(), count($result->get('data')));
        $this->assertEquals($total, $result->get('pagination')['total']);
        $this->assertEquals($perPage, $result->get('pagination')['per_page']);
        $this->assertEquals($currentPage, $result->get('pagination')['current_page']);
    }
}
