<?php

declare(strict_types=1);

namespace Webauthn\Tests\Bundle\Functional;

use Assert\Assertion;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Webauthn\Bundle\Security\Guesser\UserEntityGuesser;
use Webauthn\PublicKeyCredentialUserEntity;

final class CurrentUserEntityGuesser implements UserEntityGuesser
{
    public function __construct(
        private Security $security
    ) {
    }

    public function findUserEntity(Request $request): PublicKeyCredentialUserEntity
    {
        $user = $this->security->getUser();
        Assertion::isInstanceOf($user, PublicKeyCredentialUserEntity::class, 'Unable to find the user entity');

        return $user;
    }
}
