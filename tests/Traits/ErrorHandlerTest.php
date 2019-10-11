<?php

namespace Tests\Traits;

use Exception;
use Illuminate\Http\Response;
use LaravelToolkit\Traits\ErrorHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tests\TestCase;

class ErrorHandlerTest extends TestCase
{
    use ErrorHandler;

    /**
     * @return void
     */
    public function testResulteNull()
    {
        $exception = new Exception();

        $result = $this->handle($exception);

        $this->assertNull($result);
    }

    /**
     * @return void
     */
    public function testResultUnauthorized()
    {
        $exception = new UnauthorizedHttpException($this->faker->name);

        $result = $this->handle($exception);

        $this->assertEquals($result->getStatusCode(), Response::HTTP_UNAUTHORIZED);
    }
}
