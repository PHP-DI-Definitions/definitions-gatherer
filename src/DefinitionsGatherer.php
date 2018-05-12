<?php declare(strict_types=1);

namespace PHPDIDefinitions;

use Composed\Package;
use function Composed\packages;
use function igorw\get_in;

final class DefinitionsGatherer
{
    private const LOCATION = 'php-di-definitions.di';

    public static function gather(string $location = self::LOCATION): iterable
    {
        $location = explode('.', $location);
        foreach (self::locations($location) as $file) {
            yield from require $file;
        }
    }

    public static function locations(array $location): iterable
    {
        /** @var Package $package */
        foreach (packages(true) as $package) {
            $config = $package->getConfig('extra');

            if ($config === null) {
                continue;
            }

            $entries = get_in(
                $config,
                $location
            );

            if ($entries === null) {
                continue;
            }

            foreach ($entries as $file) {
                yield $package->getPath($file);
            }
        }
    }
}
