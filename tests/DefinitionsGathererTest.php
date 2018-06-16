<?php declare(strict_types=1);

namespace PHPDIDefinitions;

use PHPUnit\Framework\TestCase;

final class DefinitionsGathererTest extends TestCase
{
    public function testDummy()
    {
        $definitions = iterator_to_array(DefinitionsGatherer::gather());

        self::assertCount(1, $definitions);
        self::assertTrue(isset($definitions[Dummy::class]));
        self::assertInternalType('callable', $definitions[Dummy::class]);
        self::assertInstanceOf(Dummy::class, $definitions[Dummy::class]());
    }
}
