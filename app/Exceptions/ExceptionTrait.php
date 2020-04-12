<?php

namespace App\Exceptions;

//use Exception;
//use App\Exceptions\ExceptionTrait;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

trait ExceptionTrait
{
    public function apiException($request, $e)
    {
        if($this->isModel($e)) {
            return $this->ModelResponse($e);
        }

        if($this->isHttp($e)) {
            return $this->HttpResponse($e);
        }

        return parent::render($request, $e);

    }

    protected function isModel($e)
    {
        return $e instanceof ModelNotFoundException;
    }

    protected function isHttp($e)
    {
        return $e instanceof NotFoundHttpException;
    }

    protected function ModelResponse($e)
    {
        return response()->json([
            'errors' => 'Products Model Not Found'
        ], Response::HTTP_NOT_FOUND);
    }

    protected function HttpResponse($e)
    {
        return response()->json([
            'errors' => 'Incorrect Route Or Route Not Found'
        ], Response::HTTP_NOT_FOUND);
    }
}
