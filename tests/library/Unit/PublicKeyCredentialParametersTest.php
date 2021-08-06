<?php

declare(strict_types=1);

namespace Webauthn\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Webauthn\PublicKeyCredentialParameters;

/**
 * @group unit
 * @group Fido2
 *
 * @covers \Webauthn\PublicKeyCredentialParameters
 *
 * @internal
 */
class PublicKeyCredentialParametersTest extends TestCase
{
    /**
     * @test
     */
    public function anPublicKeyCredentialParametersCanBeCreatedAndValueAccessed(): void
    {
        $parameters = new PublicKeyCredentialParameters('type', 100);

        static::assertEquals('type', $parameters->getType());
        static::assertEquals(100, $parameters->getAlg());
        static::assertEquals('{"type":"type","alg":100}', json_encode($parameters));

        $data = PublicKeyCredentialParameters::createFromString('{"type":"type","alg":100}');
        static::assertEquals('type', $data->getType());
        static::assertEquals(100, $data->getAlg());
        static::assertEquals('{"type":"type","alg":100}', json_encode($data));
    }
}
