<?php

declare(strict_types=1);

namespace PHPDIDefinitions;

use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DefinitionsGathererTest extends TestCase
{
    public function testDummy(): void
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
