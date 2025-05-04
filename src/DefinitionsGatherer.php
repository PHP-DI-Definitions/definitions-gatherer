<?php

declare(strict_types=1);

namespace PHPDIDefinitions;

use function glob;
use function is_array;
use function strpos;
use function WyriHaximus\get_in_packages_composer_path;

final class DefinitionsGatherer
{
    private const string LOCATION = 'extra.php-di-definitions.di';

    /** @return iterable<string, mixed> */
    public static function gather(string $location = self::LOCATION): iterable
    {
        yield from self::requires(get_in_packages_composer_path($location));
    }

    /**
     * @param iterable<string> $files
     *
     * @return iterable<string, mixed>
     */
    private static function requires(iterable $files): iterable
    {
        foreach ($files as $file) {
            yield from self::require($file);
        }
    }

    /** @return iterable<string, mixed> */
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

        /** @phpstan-ignore generator.keyType */
        yield from require $file;
    }
}
