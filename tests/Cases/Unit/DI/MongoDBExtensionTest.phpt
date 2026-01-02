<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\DI;

use Nettrine\MongoDB\DI\MongoDBExtension;
use Contributte\Tester\Environment;
use Contributte\Tester\Toolkit;
use MongoDB\Client;
use MongoDB\Driver\Manager;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Tester\Assert;

require_once __DIR__ . '/../../../bootstrap.php';

Toolkit::test(function (): void {
	$loader = new ContainerLoader(Environment::getTestDir(), true);
	$class = $loader->load(
		static function (Compiler $compiler): void {
			$compiler->addExtension('mongodb', new MongoDBExtension());
			$compiler->addConfig([
				'parameters' => [
					'tempDir' => Environment::getTestDir(),
					'appDir' => __DIR__,
				],
			]);
		},
		[getmypid(), 1]
	);

	/** @var Container $container */
	$container = new $class();

	$client = $container->getByType(Client::class);

	Assert::type(Client::class, $client);
	Assert::type(Manager::class, $client->getManager());
});
