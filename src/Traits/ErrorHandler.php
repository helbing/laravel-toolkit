<?php

namespace LaravelToolkit\Traits;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

trait ErrorHandler
{
    /**
     * @param UnauthorizedHttpException $exception
     * @return JsonResponse
     */
    public function setUnauthorizeResponse(UnauthorizedHttpException $exception): JsonResponse
    {
        return response()->json(['message' => $exception->getMessage()], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @param ValidationException $exception
     * @return JsonResponse
     */
    public function setValidationResponse(ValidationException $exception): JsonResponse
    {
        return response()->json($exception->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * @param BadRequestHttpException $exception
     * @return JsonResponse
     */
    public function setBadRequestResponse(BadRequestHttpException $exception): JsonResponse
    {
        return response()->json(['message' => $exception->getMessage()], Response::HTTP_BAD_REQUEST);
    }

    /**
     * @param NotFoundHttpException $exception
     * @return JsonResponse
     */
    public function setNotFoundResponse(NotFoundHttpException $exception): JsonResponse
    {
        return response()->json(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param ModelNotFoundException $exception
     * @return JsonResponse
     */
    public function setModelNotFoundResponse(ModelNotFoundException $exception): JsonResponse
    {
        return response()->json(['message' => $exception->getMessage()], Response::HTTP_NOT_FOUND);
    }

    /**
     * @param AccessDeniedHttpException $exception
     * @return JsonResponse
     */
    public function setAccessDeniedResponse(AccessDeniedHttpException $exception): JsonResponse
    {
        return response()->json(['message' => $exception->getMessage()], Response::HTTP_FORBIDDEN);
    }

    /**
     * @param Exception $exception
     * @return JsonResponse|null
     */
    public function handle(Exception $exception): ?JsonResponse
    {
        if ($exception instanceof UnauthorizedHttpException) {
            return $this->setUnauthorizeResponse($exception);
        }

        if ($exception instanceof ValidationException) {
            return $this->setValidationResponse($exception);
        }

        if ($exception instanceof BadRequestHttpException) {
            return $this->setBadRequestResponse($exception);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->setNotFoundResponse($exception);
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->setModelNotFoundResponse($exception);
        }

        if ($exception instanceof AccessDeniedHttpException) {
            return $this->setAccessDeniedResponse($exception);
        }

        return null;
    }
}
