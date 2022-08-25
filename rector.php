<?php

declare(strict_types=1);

use Rector\Config\RectorConfig;
use Rector\Core\ValueObject\PhpVersion;
use Rector\Set\ValueObject\SetList;
use RectorNette\Set\NetteSetList;
use Rector\TypeDeclaration\Rector\FunctionLike\ReturnTypeDeclarationRector;


return static function (RectorConfig $rectorConfig): void {
	$rectorConfig->paths([
		__DIR__ . '/src',
		__DIR__ . '/tests',
	]);

	$rectorConfig->importNames();
	$rectorConfig->parallel();
	$rectorConfig->cacheDirectory(__DIR__ . '/temp/rector');

	// Define what rule sets will be applied
	$rectorConfig->import(SetList::PHP_80);
	$rectorConfig->import(SetList::CODE_QUALITY);
//	$rectorConfig->import(NetteSetList::NETTE_CODE_QUALITY);
	$rectorConfig->import(NetteSetList::ANNOTATIONS_TO_ATTRIBUTES);

	$rectorConfig->phpVersion(PhpVersion::PHP_80);

	$services = $rectorConfig->services();
	$services->set(ReturnTypeDeclarationRector::class);
};
