<?php

namespace Api\Exceptions;

class BadInputException extends ApiException {
	protected   $statusCode = 422,
				$message = "bad_input";
}