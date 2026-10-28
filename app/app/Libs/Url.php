<?php

/**
 * Url handler.
 */

namespace App\Libs;

class Url
{
    private string $domain;
    private string $path;
    private array $queryString = [];

    /**
     * Sets the domain.
     *
     * @param string $domainUrl
     */
    public function setDomain(string $domainUrl): self
    {
        $this->domain = $domainUrl;

        return $this;
    }

    /**
     * Sets the url path.
     *
     * @param string $path
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

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
        $this->queryString[$key] = $value;

        return $this;
    }

    /**
     * Remove the url query string.
     *
     * @param int|string $key
     */
    public function removeQuery(int|string $key): self
    {
        unset($this->queryString[$key]);

        return $this;
    }

    /**
     * Sets the url query string.
     *
     * @param array $query Search params.
     */
    public function setQuery(array $query): self
    {
        $this->queryString = $query;

        return $this;
    }

    /**
     * Build and returns complete url.
     */
    public function get(): string
    {
        return sprintf(
            '%s%s%s',
            $this->domain,
            isset($this->path) ? '/' . trim($this->path, '/') : '',
            count($this->queryString) ? '?' . http_build_query($this->queryString) : '',
        );
    }
}
