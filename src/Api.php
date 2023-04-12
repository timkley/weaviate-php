<?php

namespace Weaviate;

use Exception;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Weaviate\Exceptions\AuthenticationException;
use Weaviate\Exceptions\NotFoundException;

class Api
{
    public HttpClient $httpClient;
    public Response $latestResponse;

    //    protected ?string $filter = null;
    //    protected ?string $order = null;
    //    protected ?int $page = null;
    //    protected ?int $pageSize = null;

    public function __construct(private readonly string $apiUrl, private readonly string $apiToken, private readonly array $additionalHeaders = [])
    {
        $this->httpClient = new HttpClient();
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

    protected function request(): PendingRequest
    {
        $httpClient = $this->httpClient
            ->withHeaders($this->additionalHeaders)
            ->baseUrl($this->apiUrl);

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
                sprintf('The requested ressource %s could not be found.', $this->latestResponse->effectiveUri())
            );
        }

        if (! $this->latestResponse->successful()) {
            throw new Exception($this->latestResponse->body());
        }

        return $this->latestResponse;
    }
}
