<?php

/**
 * Create requests.
 */

namespace App\Libs;

use App\Consts\Methods;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Throwable;

class Api
{
    private array $headers = [];
    private Methods $method = Methods::Get;
    public readonly Url $url;
    public readonly Client $client;

    public function __construct()
    {
        $this->url = new Url();
        $this->client = new Client([
            'http_errors' => false,
            'curl' => [
                CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
            ]
        ]);
    }

    /**
     * Sets the method property.
     *
     * @param Methods $method
     */
    public function setMethod(Methods $method): self
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Sets the request headers.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Include value into headers.
     *
     * @param string $key
     * @param string $value
     */
    public function addHeader(string $key, string $value): self
    {
        $this->headers[$key] = $value;

        return $this;
    }

    /**
     * Remove a headers value by key.
     *
     * @param string $key
     */
    public function removeHeader(string $key): self
    {
        unset($this->headers[$key]);

        return $this;
    }

    /**
     * Sets the domain.
     *
     * @param string $domainUrl
     */
    public function setDomain(string $domainUrl): self
    {
        $this->url->setDomain($domainUrl);

        return $this;
    }

    /**
     * Sets the url path.
     *
     * @param string $path
     */
    public function setPath(string $path): self
    {
        $this->url->setPath($path);

        return $this;
    }

    /**
     * Sets the url query string.
     *
     * @param int|string $key
     * @param mixed $value
     */
    public function addQuery(int|string $key, mixed $value): self
    {
        $this->url->addQuery($key, $value);

        return $this;
    }

    /**
     * Remove the url query string.
     *
     * @param int|string $key
     */
    public function removeQuery(int|string $key): self
    {
        $this->url->removeQuery($key);

        return $this;
    }

    /**
     * Sets the url query string.
     *
     * @param array $query Search params.
     */
    public function setQuery(array $query): self
    {
        $this->url->setQuery($query);

        return $this;
    }

    /**
     * @param array $body Request body.
     */
    public function request(array $body = []): object
    {
        try {
            $response = $this->client->request(
                $this->method->value,
                $this->url->get(),
                [
                    'headers' => $this->headers,
                    'body' => json_encode($body),
                ]
            );
            $response = json_decode($response->getBody()->getContents());
        } catch (Throwable $error) {
            return $this->responseError($error->getMessage());
        }

        return is_object($response) ? $response : $this->responseError(
            'Invalid response format, expected an object.'
        );
    }

    /**
     * @param string $message
     */
    private function responseError(string $message): object
    {
        return (object) ['error' => $message];
    }
}
