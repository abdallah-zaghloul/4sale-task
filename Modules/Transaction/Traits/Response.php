<?php
namespace Modules\Transaction\Traits;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Modules\Transaction\Enums\HttpStatusCodeEnum;

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
            'message'=> $message ?? @trans('transaction::messages.bad_request'),
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
            'message'=> $message ?? @trans('transaction::messages.success'),
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
            'message'=> $message ?? @trans('transaction::messages.success'),
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
            'message'=> $message ?? @trans('transaction::messages.unavailable_server'),
        ], ($errorHttpCode ?? HttpStatusCodeEnum::UnavailableServer)->value);

        return $shouldThrow ? throw new HttpResponseException($response) : $response;
    }


}
