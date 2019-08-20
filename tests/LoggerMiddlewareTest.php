<?php
declare(strict_types = 1);

namespace SaKer\Guzzle\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use SaKer\Guzzle\Middleware\Logging\LoggerMiddlewareFactory;
use SaKer\Guzzle\Middleware\Logging\RequestLogger;



/**
 * @testCase
 */
class LoggerMiddlewareTest extends TestCase
{

	protected function tearDown() : void
	{
		parent::tearDown();
	}



	public function testLogException() : void
	{
		$logger = new LoggerMock();
		$response = new RequestException('Error Communicating with Server', new Request('GET', 'test'));
		$client = $this->createHttpClient($response, $logger);

		try {
			$client->request('GET', '/');
		} catch (\Throwable $exception) {
			$this->assertEquals('Error Communicating with Server', $exception->getMessage());
			$this->assertEquals('Request failed', $logger->getLogs()[0]['message']);
		}
	}



	public function testLogSuccess() : void
	{
		$logger = new LoggerMock();
		$response = new Response(200, ['X-Foo' => 'Bar']);
		$client = $this->createHttpClient($response, $logger);

		$this->assertEquals($client->request('GET', '/')->getStatusCode(), 200);
		$this->assertEquals('Request successful', $logger->getLogs()[0]['message']);
	}



	/**
	 * @param \Throwable|Response $response
	 * @param LoggerInterface $logger
	 * @return Client
	 */
	private function createHttpClient($response, LoggerInterface $logger) : Client
	{
		$mockHandler = new MockHandler([$response]);
		$handler = HandlerStack::create($mockHandler);

		$handler->push(LoggerMiddlewareFactory::create(new RequestLogger($logger)));

		return new Client(['handler' => $handler]);
	}

}
