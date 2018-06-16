<?php declare(strict_types=1);

namespace PHPDIDefinitions;

use function WyriHaximus\get_in_packages_composer_path;

final class DefinitionsGatherer
{
    private const LOCATION = 'extra.php-di-definitions.di';

    public static function gather(string $location = self::LOCATION): iterable
    {
        foreach (get_in_packages_composer_path($location) as $file) {
            yield from require $file;
        }
    }
}
