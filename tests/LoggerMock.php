<?php
declare(strict_types = 1);

namespace SaKer\Guzzle\Tests;

use Psr\Log\LoggerInterface;



class LoggerMock implements LoggerInterface
{

	/**
	 * @var mixed[]
	 */
	private $logs = [];

	public const LOGGED_LEVEL = 'level';
	public const LOGGED_MESSAGE = 'message';
	public const LOGGED_CONTEXT = 'context';


	// phpcs:disable
	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function info($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function error($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function emergency($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function alert($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function critical($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function warning($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function notice($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function debug($message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}



	/**
	 * @param mixed $level
	 * @param string $message
	 * @param mixed[] $context
	 */
	public function log($level, $message, array $context = []) : void
	{
		$this->logs[] = [
			self::LOGGED_LEVEL => $level,
			self::LOGGED_MESSAGE => $message,
			self::LOGGED_CONTEXT => $context,
		];
	}
	// phpcs:enable



	/**
	 * @return mixed[]
	 */
	public function getLogs() : array
	{
		return $this->logs;
	}

}
