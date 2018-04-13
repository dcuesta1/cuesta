<?php

namespace App\Exceptions;

class BadInputException extends AppException {
	protected   $statusCode = 422,
				$message = "bad_input";
}