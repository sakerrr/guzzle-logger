<?php
declare(strict_types = 1);

namespace SaKer\Guzzle\Middleware\Logging;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;



class RequestLogger implements RequestLoggerInterface
{

	/**
	 * @var LoggerInterface
	 */
	private $logger;



	public function __construct(LoggerInterface $logger)
	{
		$this->logger = $logger;
	}



	public function logSuccess(string $message, RequestInterface $request, ?ResponseInterface $response = NULL) : void
	{
		$this->logger->info($message, $this->getContext($request, $response));
	}



	public function logError(string $message, RequestInterface $request, ?ResponseInterface $response, \Throwable $exception) : void
	{
		$this->logger->error($message, $this->getContextForError($request, $response, $exception));
	}



	/**
	 * @return mixed[]
	 */
	private function getContext(RequestInterface $request, ?ResponseInterface $response) : array
	{
		$context = [];

		$context['requestMethod'] = $request->getMethod();
		$context['requestUrl'] = (string) $request->getUri();
		$context['requestHeaders'] = self::serializeHeaders($request->getHeaders());
		$context['requestBody'] = (string) $request->getBody();

		if ($response !== NULL) {
			$context['responseStatus'] = $response->getStatusCode();
			$context['responseHeaders'] = self::serializeHeaders($response->getHeaders());
			$context['responseBody'] = (string) $response->getBody();
		}


		return $context;
	}



	/**
	 * @return mixed[]
	 */
	private function getContextForError(RequestInterface $request, ?ResponseInterface $response, \Throwable $exception) : array
	{
		$context = $this->getContext($request, $response);

		$context['exception'] = $exception;
		$context['exceptionMessage'] = $exception->getMessage();
		$context['exceptionType'] = get_class($exception);

		return $context;
	}



	/**
	 * @param mixed[][] $headers
	 */
	private static function serializeHeaders(array $headers) : string
	{
		$result = [];

		foreach ($headers as $key => $val) {
			foreach ($val as $v) {
				$result[] = $key . ': ' . $v;
			}
		}

		return implode("\n", $result);
	}

}
