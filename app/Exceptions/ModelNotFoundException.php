<?php

namespace App\Exceptions;


class ModelNotFoundException extends ApiException {
	protected   $message = "content_not_found",
				$statusCode = 404;

}