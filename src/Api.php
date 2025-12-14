<?php

namespace Weaviate;

use Exception;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Weaviate\Exceptions\AuthenticationException;
use Weaviate\Exceptions\NotFoundException;

class Api
{
    public HttpClient $httpClient;
    public Response|PromiseInterface $latestResponse;

    protected string $weaviateApiVersion = 'v1';

    protected array $queryParameters = [];

    public function __construct(
        private readonly string $apiUrl,
        #[\SensitiveParameter]
        private readonly string $apiToken,
        private readonly array $additionalHeaders = [],
        private readonly int $timeout = 30,
    ) {
        $this->httpClient = new HttpClient();
    }

    public function setQueryParameters(array $queryParameters): void
    {
        $this->queryParameters = $queryParameters;
    }

    public function getQueryParameters(): array
    {
        return $this->queryParameters;
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function get(string $endpoint): Response
    {
        $this->latestResponse = $this->request()->get($endpoint);

        return $this->response();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function post(string $endpoint, array $data = []): Response
    {
        $this->latestResponse = $this->request()->post($endpoint, $data);

        return $this->response();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function put(string $endpoint, array $data = []): Response
    {
        $this->latestResponse = $this->request()->put($endpoint, $data);

        return $this->response();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function patch(string $endpoint, array $data = []): Response
    {
        $this->latestResponse = $this->request()->patch($endpoint, $data);

        return $this->response();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function delete(string $endpoint, array $data = []): Response
    {
        $this->latestResponse = $this->request()->delete($endpoint, $data);

        return $this->response();
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     */
    public function head(string $endpoint): Response
    {
        $this->latestResponse = $this->request()->head($endpoint);

        return $this->response();
    }

    protected function request(): PendingRequest
    {
        $httpClient = $this->httpClient
            ->withHeaders($this->additionalHeaders)
            ->withOptions(['query' => $this->queryParameters])
            ->timeout($this->timeout)
            ->baseUrl(rtrim($this->apiUrl, '/') . '/' . $this->weaviateApiVersion);

        if ($this->apiToken) {
            $httpClient = $httpClient->withToken($this->apiToken);
        }

        return $httpClient;
    }

    /**
     * @throws AuthenticationException
     * @throws NotFoundException
     * @throws Exception
     */
    protected function response(): Response
    {
        if ($this->latestResponse->status() === 401) {
            throw new AuthenticationException($this->latestResponse->json('message.description'));
        }

        if ($this->latestResponse->status() === 404) {
            throw new NotFoundException(
                sprintf('The requested resource %s could not be found.', $this->latestResponse->effectiveUri())
            );
        }

        if (! $this->latestResponse->successful()) {
            throw new Exception($this->latestResponse->body());
        }

        return $this->latestResponse;
    }
}
