<?php

namespace App\Exceptions;

class UnauthorizedAccessException extends ApiException {

	protected   $message = "access_denied",
				$statusCode = 401;

	public function report()
    {

    }
}