<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->wantsJson()) {   //add Accept: application/json in request
            return $this->handleApiException($request, $e);
        } else {
            $retval = parent::render($request, $e);
        }

        return $retval;
    }

    private function handleApiException($request, Throwable $e)
    {
        $e = $this->prepareException($e);

        if ($e instanceof \Illuminate\Auth\AuthenticationException) {
            $e = $this->unauthenticated($request, $e);
        }

        if ($e instanceof \Illuminate\Validation\ValidationException) {
            $e = $this->convertValidationExceptionToResponse($e, $request);
        }

        return $this->customApiResponse($e);
    }

    private function customApiResponse($e): \Illuminate\Http\JsonResponse
    {
        if (method_exists($e, 'getStatusCode')) {
            $statusCode = $e->getStatusCode();
        } else {
            $statusCode = 500;
        }

        $response = [];

        switch ($statusCode) {
            case 401:
                $response['message'] = __('exceptions.unauthorized');
                break;
            case 403:
                $response['message'] = __('exceptions.forbidden');
                break;
            case 404:
                $response['message'] = __('exceptions.not_found');
                break;
            case 405:
                $response['message'] = __('exceptions.method_not_allowed');
                break;
            case 422:
                $response['message'] = $e->original['message'];
                $response['errors'] = $e->original['errors'];
                break;
            default:
                $response['message'] = ($statusCode == 500) ? 'Whoops, looks like something went wrong' : $e->getMessage();
                break;
        }

        if (config('app.debug')) {
            $response['trace'] = $e->getTrace();
            $response['code'] = $e->getCode();
        }

        $response['status'] = $statusCode;

        return response()->json($response, $statusCode);
    }
}
