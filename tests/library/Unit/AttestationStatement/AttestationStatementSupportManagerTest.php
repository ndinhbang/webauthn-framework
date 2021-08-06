<?php

declare(strict_types=1);

namespace Webauthn\Tests\Unit\AttestationStatement;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Webauthn\AttestationStatement\AttestationStatementSupportManager;

/**
 * @group unit
 * @group Fido2
 *
 * @covers \Webauthn\AttestationStatement\AttestationStatementSupportManager
 *
 * @internal
 */
class AttestationStatementSupportManagerTest extends TestCase
{
    /**
     * @test
     */
    public function theAttestationFormatIsNotSupported(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The attestation statement format "bar" is not supported.');
        $manager = AttestationStatementSupportManager::create();
        $manager->get('bar');
    }
}
