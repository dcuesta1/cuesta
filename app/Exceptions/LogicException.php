<?php

namespace Api\Exceptions;

class LogicException extends ApiException {

	protected   $message = "internal_server_error",
				$statusCode = 500;

}