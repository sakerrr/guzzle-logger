<?php
declare(strict_types = 1);

namespace SaKer\Guzzle\Middleware\Logging;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\RejectedPromise;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;



class LoggerMiddlewareFactory
{

	public static function create(RequestLoggerInterface $logger) : callable
	{
		return function (callable $handler) use ($logger) {
			return function (RequestInterface $request, array $options) use ($handler, $logger) {
				return $handler($request, $options)->then(
					function (ResponseInterface $response) use ($request, $logger) : ResponseInterface {
						$logger->logSuccess('Request successful', $request, $response);

						return $response;
					},
					function (\Throwable $exception) use ($request, $logger) : RejectedPromise {
						$response = $exception instanceof RequestException
							? $exception->getResponse()
							: NULL;

						$logger->logError('Request failed', $request, $response, $exception);

						return new RejectedPromise($exception);
					}
				);
			};
		};
	}

}
