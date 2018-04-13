<?php

namespace Api\Exceptions;


class ModelNotFoundException extends ApiException {
	protected   $message = "content_not_found",
				$statusCode = 404;

}