<?php declare(strict_types=1);

namespace PHPDIDefinitions;

use PHPUnit\Framework\TestCase;
use React\EventLoop\LoopInterface;

final class DefinitionsGathererTest extends TestCase
{
    public function testEventLoop()
    {
        $definitions = iterator_to_array(DefinitionsGatherer::gather());

        self::assertCount(1, $definitions);
        self::assertTrue(isset($definitions[LoopInterface::class]));
        self::assertInternalType('callable', $definitions[LoopInterface::class]);
    }
}
