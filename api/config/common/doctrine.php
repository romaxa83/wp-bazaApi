<?php

declare(strict_types=1);

use Api\Infrastructure\Doctrine\Type;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL;

return [

	EntityManagerInterface::class => function(ContainerInterface $container) {
		$params = $container['config']['doctrine'];
		$config = Setup::createAnnotationMetadataConfiguration(
			$params['metadata_dirs'],
			$params['dev_mode'],
			$params['cache_dir'],
			new FilesystemCache(
				$params['cache_dir']
			),
			false
		);
		return EntityManager::create(
			$params['connection'],
			$config
		);
	},

	'config' => [
		'doctrine' => [
			'dev_mode' => false,
			'cache_dir' => 'var/cache/doctrine',   //куда кешировать данные
			'metadata_dirs' => [//с какой папки брать сущьности
				'src/Model/NewBaza/Entity',
				'src/Model/OldBaza/Entity',
			],
			'connection' => [
				'url' => getenv('API_DB_URL'),
			],
		]
	]
];