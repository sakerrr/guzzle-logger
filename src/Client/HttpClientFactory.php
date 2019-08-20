<?php
declare(strict_types = 1);

namespace SaKer\Guzzle\Client;

use GuzzleHttp\Client;
use Psr\Log\LoggerInterface;
use SaKer\Guzzle\Middleware\HandlerStackFactory;
use SaKer\Guzzle\Middleware\Logging\RequestLogger;



class HttpClientFactory
{

	/**
	 * @param LoggerInterface $logger
	 * @param mixed[]|NULL $options
	 */
	public static function create(LoggerInterface $logger, ?array $options = NULL) : Client
	{
		if (!isset($options['handler'])) {
			$requestLogger = new RequestLogger($logger);
			$options['handler'] = HandlerStackFactory::create($requestLogger);
		}

		return new Client($options);
	}

}
