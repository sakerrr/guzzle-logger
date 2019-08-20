<?php
declare(strict_types = 1);

namespace SaKer\Guzzle\Middleware\Logging;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;



interface RequestLoggerInterface
{

	public function logSuccess(string $message, RequestInterface $request, ?ResponseInterface $response = NULL) : void;



	public function logError(string $message, RequestInterface $request, ?ResponseInterface $response, \Throwable $exception) : void;

}
