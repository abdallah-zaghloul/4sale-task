<?php
namespace App\Traits;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use App\Enums\HttpStatusCodeEnum;

trait Response
{

    /**
     * @param array $errors
     * @param string|null $message
     * @param HttpStatusCodeEnum|null $errorHttpCode
     * @param bool $shouldThrow
     * @return mixed
     */
    public function errorResponse(array $errors, ?string $message = null , ?HttpStatusCodeEnum $errorHttpCode = null, bool $shouldThrow = true): mixed
    {
        $response = response()->json([
            'status'=> false,
            'message'=> $message ?? @trans('moduleName::messages.bad_request'),
            'errors'=> $errors,
        ],$errorHttpCode->value ?? HttpStatusCodeEnum::BadRequest->value);

        return $shouldThrow ? throw new HttpResponseException($response) : $response;
    }


    /**
     * @param string|null $message
     * @return JsonResponse
     */
    public function successResponse(?string $message = null): JsonResponse
    {
        return response()->json([
            'status'=> true,
            'message'=> $message ?? @trans('moduleName::messages.success'),
        ], HttpStatusCodeEnum::Success->value);
    }

    /**
     * @param array $data
     * @param string|null $message
     * @return JsonResponse
     */
    public function dataResponse(array $data, ?string $message = null): JsonResponse
    {
        return response()->json([
            'status'=> true,
            'message'=> $message ?? @trans('moduleName::messages.success'),
            'data'=> $data,
        ], HttpStatusCodeEnum::Success->value);
    }


    /**
     * @param string|null $message
     * @param HttpStatusCodeEnum|null $errorHttpCode
     * @param bool $shouldThrow
     * @return mixed
     */
    public function errorMessage(?string $message = null , ?HttpStatusCodeEnum $errorHttpCode = null, bool $shouldThrow = true): mixed
    {
        $response = response()->json([
            'status'=> false,
            'message'=> $message ?? @trans('moduleName::messages.unavailable_server'),
        ], ($errorHttpCode ?? HttpStatusCodeEnum::UnavailableServer)->value);

        return $shouldThrow ? throw new HttpResponseException($response) : $response;
    }


}
