<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\DI;

use MongoDB\Client;
use Nette\DI\Compiler;
use Nette\DI\Container;
use Nette\DI\ContainerLoader;
use Nettrine\MongoDB\DI\MongoDBExtension;
use Tests\Toolkit\TestCase;

final class MongoDBExtensionTest extends TestCase
{

	public function testRegisterExtension(): void
	{
		$loader = new ContainerLoader(TEMP_PATH, true);
		$class = $loader->load(static function (Compiler $compiler): void {
			$compiler->addExtension('mongodb', new MongoDBExtension());
			$compiler->addConfig([
				'parameters' => [
					'tempDir' => TEMP_PATH,
					'appDir' => __DIR__,
				],
			]);
		}, self::class . __METHOD__);

		/** @var Container $container */
		$container = new $class();
		$client = $container->getByType(Client::class);
		$this->assertInstanceOf(Client::class, $client);
	}

}
