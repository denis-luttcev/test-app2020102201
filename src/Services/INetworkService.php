<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Http client API for make requests to external resources
 */
interface INetworkService
{
    /**
     * Makes GET request to specified URL
     * 
     * @param string $url allowable not empty
     * @param array|null $params
     * @param array|null $headers
     * @return string HTTP response
     * @throws RuntimeException if network connection failure
     * @throws DomainException if URL not set
     */
    function makeGetRequest(
            string $url,
            array $params = null,
            array $headers = null
    ): string;
}
