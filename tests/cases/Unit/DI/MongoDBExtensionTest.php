<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\DI;

use MongoDB\Client;
use MongoDB\Driver\Manager;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nettrine\MongoDB\DI\MongoDBExtension;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../../../bootstrap.php';


/**
 * @testCase
 */
final class MongoDBExtensionTest extends TestCase
{

	public function testRegisterExtension(): void
	{
		$loader = new ContainerLoader(TEMP_DIR, true);
		$class = $loader->load(
			static function (Compiler $compiler): void {
				$compiler->addExtension('mongodb', new MongoDBExtension());
				$compiler->addConfig(
					[
						'parameters' => [
							'tempDir' => TEMP_DIR,
							'appDir' => __DIR__,
						],
					]
				);
			},
			[getmypid(), 1]
		);

		/** @var Container $container */
		$container = new $class();

		$client = $container->getByType(Client::class);

		Assert::type(Client::class, $client);
		Assert::type(Manager::class, $client->getManager());
	}

}


(new MongoDBExtensionTest())->run();
