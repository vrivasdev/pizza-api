<?php

namespace App\Exceptions;

use App\Helpers\ResponseAPI;

use App\Exceptions\MenuNotFoundException;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Component\HttpFoundation\Response;

trait ExceptionTrait
{
	public function apiException($request, $e)
	{ 
        if ($this->isModel($e)) {
            return $this->modelResponse($e);
        }
        
        if ($this->isHttp($e)) {
            return $this->httpResponse($e);
	    }

        if ($this->isMenuNotFoundException($e)) {
            return $this->MenuNotFoundException($e);
        }

        return parent::render($request, $e);
    }
    
    protected function isMenuNotFoundException($e)
    {
        return $e instanceof MenuNotFoundException;
    }

	protected function modelResponse($e)
	{
		return response()->json([
            'errors' => 'Product Model not found'
        ],Response::HTTP_NOT_FOUND);
    }
    
	protected function httpResponse($e)
	{
		return response()->json([
            'errors' => 'Incorect route'
        ],Response::HTTP_NOT_FOUND);
    }   

    protected function MenuNotFoundException($e)
	{
        return $this->getResponse($e, 'MenuNotFound');
    }
    
    protected function getResponse($e, $title='') 
    {
        return ResponseAPI::error($e->getMessage(), $title, $e->getCode());
    }
}