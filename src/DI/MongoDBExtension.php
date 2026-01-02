<?php declare(strict_types = 1);

namespace Nettrine\MongoDB\DI;

use MongoDB\Client;
use Nette\DI\CompilerExtension;
use Nette\DI\Definitions\Statement;
use Nette\Schema\Expect;
use Nette\Schema\Schema;
use stdClass;

/**
 * @property-read stdClass $config
 */
final class MongoDBExtension extends CompilerExtension
{

	/**
	 * @see https://www.php.net/manual/en/mongodb-driver-manager.construct.php
	 */
	public function getConfigSchema(): Schema
	{
		return Expect::structure([
			'uri' => Expect::anyOf(Expect::string(), Expect::type(Statement::class))->default('mongodb://127.0.0.1/'),
			'uriOptions' => Expect::array([]),
			'driverOptions' => Expect::array([]),
		]);
	}

	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->config;

		$builder->addDefinition($this->prefix('client'))
			->setType(Client::class)
			->setFactory(Client::class, [
				$config->uri,
				$config->uriOptions,
				$config->driverOptions,
			]);
	}

}
