<?php

declare(strict_types=1);

namespace PHPDIDefinitions;

use function Safe\glob;
use function strpos;
use function WyriHaximus\get_in_packages_composer_path;

final class DefinitionsGatherer
{
    private const LOCATION = 'extra.php-di-definitions.di';

    /**
     * @return iterable<string, mixed>
     */
    public static function gather(string $location = self::LOCATION): iterable
    {
        yield from self::requires(get_in_packages_composer_path($location));
    }

    /**
     * @param iterable<string> $files
     *
     * @return iterable<string>
     */
    private static function requires(iterable $files): iterable
    {
        foreach ($files as $file) {
            yield from self::require($file);
        }
    }

    /**
     * @return iterable<string, mixed>
     */
    private static function require(string $file): iterable
    {
        if (strpos($file, '*') !== false) {
            /**
             * @psalm-suppress PossiblyInvalidArgument
             */
            yield from self::requires(glob($file));

            return;
        }

        /**
         * @psalm-suppress UnresolvableInclude
         */
        yield from require $file;
    }
}
