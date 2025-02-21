<?php

declare(strict_types=1);

namespace Webauthn\Bundle\Repository;

use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use RuntimeException;
use Webauthn\MetadataService\CanLogData;
use Webauthn\PublicKeyCredentialSource;
use Webauthn\PublicKeyCredentialUserEntity;

/**
 * This dummy Public Key Credential Source Repository is set to allow the bundle to be installed even if the real
 * repository is not set in the configuration file. This class shall be replaced in favour of your own implementation.
 */
class DummyPublicKeyCredentialSourceRepository implements PublicKeyCredentialSourceRepositoryInterface, CanLogData
{
    public function __construct(
        private LoggerInterface $logger = new NullLogger()
    ) {
    }

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function findAllForUserEntity(PublicKeyCredentialUserEntity $publicKeyCredentialUserEntity): array
    {
        $this->logger->critical(
            'Please change the Public Key Credential Source Repository in the bundle configuration. See https://webauthn-doc.spomky-labs.com/the-webauthn-server/the-symfony-way#repositories-1'
        );
        throw new RuntimeException(
            'You are using the DummyPublicKeyCredentialSourceRepository service. Please create your own repository'
        );
    }

    public function findOneByCredentialId(string $publicKeyCredentialId): ?PublicKeyCredentialSource
    {
        $this->logger->critical(
            'Please change the Public Key Credential Source Repository in the bundle configuration. See https://webauthn-doc.spomky-labs.com/the-webauthn-server/the-symfony-way#repositories-1'
        );
        throw new RuntimeException(
            'You are using the DummyPublicKeyCredentialSourceRepository service. Please create your own repository'
        );
    }
}
