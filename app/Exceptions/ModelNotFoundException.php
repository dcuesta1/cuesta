<?php

namespace App\Exceptions;


class ModelNotFoundException extends AppException {
	protected   $message = "content_not_found",
				$statusCode = 404;

}