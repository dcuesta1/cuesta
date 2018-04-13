<?php

namespace App\Exceptions;

class LogicException extends AppException {

	protected   $message = "internal_server_error",
				$statusCode = 500;

}