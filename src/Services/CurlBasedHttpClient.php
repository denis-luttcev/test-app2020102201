<?php
declare(strict_types=1);

namespace App\Services;

/**
 * Http client based on cURL
 */
class CurlBasedHttpClient implements INetworkService
{
    /**
     * @var CurlBasedHttpClient?
     */
    private static $instance = null;
    /**
     * @var resource?
     */
    private $connection = null;
    
    private function __construct() {}
    
    public static function getInstance(): CurlBasedHttpClient
    {
        if (is_null(self::$instance)) {
            self::$instance = new CurlBasedHttpClient();
            return self::$instance;
        } else {
            return self::$instance;
        }
    }

    /**
     * @throws RuntimeException
     */
    private function init(): void
    {
        $this->connection = curl_init();
        if (false !== $this->connection) {
            curl_setopt($this->connection, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($this->connection, CURLOPT_RETURNTRANSFER, 1);
        } else {
            $this->connection = null;
            throw new RuntimeException('Network connection failure.');
        }
    }
    
    private function close(): void
    {
        curl_close($this->connection);
        $this->connection = null;
    }

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
    public function makeGetRequest(
            string $url,
            array $params = null,
            array $headers = null
    ): string {
        if (!empty($url)) {
            $this->init();
            curl_setopt($this->connection, CURLOPT_HTTPGET, 1);
            
            $url .= $params ? $this->prepareGetParams($params) : '';
            curl_setopt($this->connection, CURLOPT_URL, $url);
            
            if (!is_null($headers)) {
                curl_setopt($this->connection, CURLOPT_HTTPHEADER, $headers);
            }
            
            $response = curl_exec($this->connection);
            
            $this->close();
            
            if (false !== $response) {
                return $response;
            } else {
                throw new RuntimeException('Network connection failure.');
            }
        } else {
            throw new DomainException('Invalid URL.');
        }
    }

    private function prepareGetParams(array $params): string
    {
        return '?' . implode('&', $params);
    }
}
