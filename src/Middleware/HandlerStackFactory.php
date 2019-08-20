<?php
declare(strict_types = 1);

namespace SaKer\Guzzle\Middleware;

use GuzzleHttp\HandlerStack;
use SaKer\Guzzle\Middleware\Logging\LoggerMiddlewareFactory;
use SaKer\Guzzle\Middleware\Logging\RequestLoggerInterface;



class HandlerStackFactory
{

	public static function create(RequestLoggerInterface $logger) : HandlerStack
	{
		$stack = HandlerStack::create();
		$stack->push(LoggerMiddlewareFactory::create($logger));

		return $stack;
	}

}
