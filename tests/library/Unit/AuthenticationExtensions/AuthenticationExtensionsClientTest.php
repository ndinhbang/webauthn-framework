<?php

declare(strict_types=1);

namespace Webauthn\Tests\Unit\AuthenticationExtensions;

use PHPUnit\Framework\TestCase;
use Webauthn\AuthenticationExtensions\AuthenticationExtension;
use Webauthn\AuthenticationExtensions\AuthenticationExtensionsClientInputs;
use Webauthn\AuthenticationExtensions\AuthenticationExtensionsClientOutputs;

/**
 * @group unit
 * @group Fido2
 *
 * @internal
 */
class AuthenticationExtensionsClientTest extends TestCase
{
    /**
     * @test
     *
     * @covers \Webauthn\AuthenticationExtensions\AuthenticationExtension
     */
    public function anAuthenticationExtensionsClientCanBeCreatedAndValueAccessed(): void
    {
        $extension = AuthenticationExtension::create('name', ['value']);

        static::assertEquals('name', $extension->name());
        static::assertEquals(['value'], $extension->value());
        static::assertEquals('["value"]', json_encode($extension));
    }

    /**
     * @test
     *
     * @covers \Webauthn\AuthenticationExtensions\AuthenticationExtensionsClientInputs
     */
    public function theAuthenticationExtensionsClientInputsCanManageExtensions(): void
    {
        $extension = AuthenticationExtension::create('name', ['value']);

        $inputs = AuthenticationExtensionsClientInputs::create();
        $inputs->add($extension);

        static::assertEquals(1, $inputs->count());
        static::assertEquals('{"name":["value"]}', json_encode($inputs));
        foreach ($inputs as $input) {
            static::assertInstanceOf(AuthenticationExtension::class, $input);
        }
    }

    /**
     * @test
     *
     * @covers \Webauthn\AuthenticationExtensions\AuthenticationExtensionsClientOutputs
     */
    public function theAuthenticationExtensionsClientOutputsCanManageExtensions(): void
    {
        $extension = AuthenticationExtension::create('name', ['value']);

        $inputs = AuthenticationExtensionsClientOutputs::create();
        $inputs->add($extension);

        static::assertEquals(1, $inputs->count());
        static::assertEquals('{"name":["value"]}', json_encode($inputs));
        foreach ($inputs as $input) {
            static::assertInstanceOf(AuthenticationExtension::class, $input);
        }
    }
}
