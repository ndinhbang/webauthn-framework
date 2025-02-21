<?php

declare(strict_types=1);

namespace Webauthn\Tests\Unit;

use ParagonIE\ConstantTime\Base64UrlSafe;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Webauthn\CollectedClientData;

/**
 * @internal
 */
final class CollectedClientDataTest extends TestCase
{
    #[Test]
    public function anCollectedClientDataCanBeCreatedAndValueAccessed(): void
    {
        $collectedClientData = new CollectedClientData(
            'raw_data',
            [
                'type' => 'type',
                'origin' => 'origin',
                'crossOrigin' => true,
                'challenge' => Base64UrlSafe::encodeUnpadded('challenge'),
                'extensions' => 'extensions',
                'tokenBinding' => [
                    'status' => 'present',
                    'id' => Base64UrlSafe::encodeUnpadded('id'),
                ],
            ]
        );

        static::assertSame('raw_data', $collectedClientData->getRawData());
        static::assertSame('origin', $collectedClientData->getOrigin());
        static::assertTrue($collectedClientData->getCrossOrigin());
        static::assertSame('challenge', $collectedClientData->getChallenge());
        static::assertSame('type', $collectedClientData->getType());
        static::assertSame(
            ['type', 'origin', 'crossOrigin', 'challenge', 'extensions', 'tokenBinding'],
            $collectedClientData->all()
        );
        static::assertTrue($collectedClientData->has('extensions'));
        static::assertSame('extensions', $collectedClientData->get('extensions'));
    }
}
