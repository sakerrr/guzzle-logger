<h2 align="left">Guzzle Logger</h1>
<p>
</p>

This middleware will take care of logging all your request and responses.

## Install

```sh
composer require sakerrr/guzzle-logger
```

## How to use

Create Guzzle\Client

```sh
$client = HttpClientFactory::create(Psr\Log\LoggerInterface $logger, ?array $options);
```

## Run tests

```sh
composer test
```

## Author

👤 **Jakub Bajnok**
