<?php

namespace App\Exceptions;
use Exception;

class ApiException extends Exception{

	protected   $statusCode = 500,
				$message = "app_error",
				$response = [];

	public function __construct($message = null, $statusCode = null, $code = 0, Exception $previous = null) {

		$message = $message ? $message : $this->message;
		$this->statusCode = $statusCode ? $statusCode : $this->statusCode;
		$this->response[$this->statusCode] = $message;

		parent::__construct($message, $code, $previous);
	}


	public function setStatusCode($code){
		$this->statusCode = $code;
	}

	public function getStatusCode()
	{
		return $this->statusCode;
	}

	public function getResponse()
	{
		return $this->response;
	}

}