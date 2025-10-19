<?php

declare(strict_types=1);

namespace PHPDIDefinitions;

use DI\Definition\Source\DefinitionFile;
use DI\Definition\Source\DefinitionSource;
use WyriHaximus\GetInPackages;

use function glob;
use function is_array;
use function strpos;

final class DefinitionsGatherer
{
    private const string LOCATION = 'extra.php-di-definitions.di';

    /** @return iterable<DefinitionSource> */
    public static function gather(string $location = self::LOCATION): iterable
    {
        yield from self::requires(GetInPackages::composerPath($location));
    }

    /**
     * @param iterable<string> $files
     *
     * @return iterable<DefinitionSource>
     */
    private static function requires(iterable $files): iterable
    {
        foreach ($files as $file) {
            yield from self::require($file);
        }
    }

    /** @return iterable<DefinitionSource> */
    private static function require(string $file): iterable
    {
        if (strpos($file, '*') !== false) {
            $files = glob($file);
            if (! is_array($files)) {
                return;
            }

            yield from self::requires($files);

            return;
        }

        yield new DefinitionFile($file);
    }
}
