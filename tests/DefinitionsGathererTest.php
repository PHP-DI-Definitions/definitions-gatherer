<?php

declare(strict_types=1);

namespace PHPDIDefinitions\Tests;

use PHPDIDefinitions\DefinitionsGatherer;
use PHPDIDefinitions\Dummy;
use PHPUnit\Framework\Attributes\Test;
use WyriHaximus\TestUtilities\TestCase;

final class DefinitionsGathererTest extends TestCase
{
    #[Test]
    public function dummy(): void
    {
        $definitions = [];
        foreach (DefinitionsGatherer::gather() as $key => $value) {
            $definitions[$key] = $value;
        }

        self::assertCount(1, $definitions);
        self::assertArrayHasKey(Dummy::class, $definitions);
        self::assertIsCallable($definitions[Dummy::class]);
        self::assertInstanceOf(Dummy::class, $definitions[Dummy::class]());
    }
}
