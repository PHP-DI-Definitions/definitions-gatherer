<?php declare(strict_types=1);

namespace PHPDIDefinitions;

use function WyriHaximus\get_in_packages_composer_path;

final class DefinitionsGatherer
{
    private const LOCATION = 'extra.php-di-definitions.di';

    public static function gather(string $location = self::LOCATION): iterable
    {
        yield from self::requires(get_in_packages_composer_path($location));
    }

    private static function requires(iterable $files): iterable
    {
        foreach ($files as $file) {
            yield from self::require($file);
        }
    }

    private static function require(string $file): iterable
    {
        if (\strpos($file, '*') !== false) {
            yield from self::requires(\glob($file));

            return;
        }

        yield from require $file;
    }
}
