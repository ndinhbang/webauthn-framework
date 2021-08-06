<?php

declare(strict_types=1);

namespace Webauthn\MetadataService;

use Assert\Assertion;
use Base64Url\Base64Url;
use JetBrains\PhpStorm\Pure;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use function Safe\json_decode;
use function Safe\sprintf;

class DistantSingleMetadata extends SingleMetadata
{
    private string $uri;

    private bool $isBase64Encoded;

    #[Pure]
    public function __construct(string $uri, bool $isBase64Encoded, private ClientInterface $httpClient, private RequestFactoryInterface $requestFactory, private array $additionalHeaders = [])
    {
        parent::__construct($uri, $isBase64Encoded); //Useless
        $this->uri = $uri;
        $this->isBase64Encoded = $isBase64Encoded;
    }

    public function getMetadataStatement(): MetadataStatement
    {
        $payload = $this->fetch();
        $json = $this->isBase64Encoded ? Base64Url::decode($payload) : $payload;
        $data = json_decode($json, true);

        return MetadataStatement::createFromArray($data);
    }

    private function fetch(): string
    {
        $request = $this->requestFactory->createRequest('GET', $this->uri);
        foreach ($this->additionalHeaders as $k => $v) {
            $request = $request->withHeader($k, $v);
        }
        $response = $this->httpClient->sendRequest($request);
        Assertion::eq(200, $response->getStatusCode(), sprintf('Unable to contact the server. Response code is %d', $response->getStatusCode()));
        $content = $response->getBody()->getContents();
        Assertion::notEmpty($content, 'Unable to contact the server. The response has no content');

        return $content;
    }
}
