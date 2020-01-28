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
	 * https://www.php.net/manual/en/mongodb-driver-manager.construct.php
	 */
	public function getConfigSchema(): Schema
	{
		return Expect::structure(
			[
				'uri'           => Expect::anyOf(Expect::string(), Expect::type(Statement::class))->default('mongodb://127.0.0.1/'),
				'uriOptions'    => Expect::array([]),
				'driverOptions' => Expect::array([]),
				//'uriOptions'    => Expect::structure(
				//    [
				//        'appname'                       => Expect::string(),
				//        'authMechanism'                 => Expect::string(),
				//        'authMechanismProperties'       => Expect::array(),
				//        'authSource'                    => Expect::string(),
				//        'canonicalizeHostname'          => Expect::bool(),
				//        'compressors'                   => Expect::string(),
				//        'connectTimeoutMS'              => Expect::int(),
				//        'gssapiServiceName'             => Expect::string(),
				//        'heartbeatFrequencyMS'          => Expect::int(),
				//        'journal'                       => Expect::bool(),
				//        'localThresholdMS'              => Expect::int(),
				//        'maxStalenessSeconds'           => Expect::int(),
				//        'password'                      => Expect::string(),
				//        'readConcernLevel'              => Expect::string(),
				//        'readPreferenceTags'            => Expect::array(),
				//        'replicaSet'                    => Expect::string(),
				//        'retryReads'                    => Expect::bool(),
				//        'retryWrites'                   => Expect::bool(),
				//        'safe'                          => Expect::bool(),
				//        'serverSelectionTimeoutMS'      => Expect::int(),
				//        'serverSelectionTryOnce'        => Expect::bool(),
				//        'slaveOk'                       => Expect::bool(),
				//        'socketCheckIntervalMS'         => Expect::int(),
				//        'socketTimeoutMS'               => Expect::int(),
				//        'ssl'                           => Expect::bool(),
				//        'tls'                           => Expect::bool(),
				//        'tlsAllowInvalidCertificates'   => Expect::bool(),
				//        'tlsAllowInvalidHostnames'      => Expect::bool(),
				//        'tlsCAFile'                     => Expect::string(),
				//        'tlsCertificateKeyFile'         => Expect::string(),
				//        'tlsCertificateKeyFilePassword' => Expect::string(),
				//        'tlsInsecure'                   => Expect::bool(),
				//        'username'                      => Expect::string(),
				//        'w'                             => Expect::anyOf(Expect::string(), Expect::int()),
				//        'wTimeoutMS'                    => Expect::anyOf(Expect::string(), Expect::int()),
				//        'zlibCompressionLevel'          => Expect::int(),
				//    ]
				//),
				//'driverOptions' => Expect::structure(
				//    [
				//        'allow_invalid_hostname' => Expect::bool(),
				//        'ca_dir'                 => Expect::string(),
				//        'ca_file'                => Expect::string(),
				//        'context'                => Expect::type('resource'),
				//        'crl_file'               => Expect::string(),
				//        'pem_file'               => Expect::string(),
				//        'weak_cert_validation'   => Expect::bool(),
				//    ]
				//),
			]
		);
	}


	public function loadConfiguration(): void
	{
		$builder = $this->getContainerBuilder();
		$config = $this->config;

		$builder->addDefinition($this->prefix('client'))
			->setType(Client::class)
			->setFactory(
				Client::class,
				[
					$config->uri,
					$config->uriOptions,
					$config->driverOptions,
				]
			);
	}

}
