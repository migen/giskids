



<?php

/**
 * Simple Request class that only parses URL into controller, method, and params
 * Based on Rerouter pattern but cleaner
 */
class Request
{
    public string $controller = '';
    public string $method = '';
    public array $params = [];
    
    // Original request data
    public string $uri = '';
    public string $path = '';
    public array $segments = [];
    public string $httpMethod = '';
    
    public function __construct()
    {
        $this->parseRequest();
    }
    
    private function parseRequest(): void
    {
        // Get the request URI
        $this->uri = trim($_SERVER['REQUEST_URI'] ?? '/', '/');
        
print_r('uri: '.$this->uri);echo '<br>';

        // Remove query string if present
        $path = parse_url('/' . $this->uri, PHP_URL_PATH);
        $this->path = trim($path, '/');
        print_r('path: '.$this->path);echo '<br>';
        
        // Split into segments
        $this->segments = $this->path ? explode('/', $this->path) : [];
        
        print_r('segments: ');print_r($this->segments);echo '<br>';


        // Get HTTP method
        $this->httpMethod = strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
        
        // Parse controller, method, and params from segments
        if (count($this->segments) >= 1) {
            $this->controller = $this->segments[0];
        }
        
        if (count($this->segments) >= 2) {
            $this->method = $this->segments[1];
        }
        
        if (count($this->segments) > 2) {
            $this->params = array_slice($this->segments, 2);
        }
    }
    
    /**
     * Check if this is a POST request
     */
    public function isPost(): bool
    {
        return $this->httpMethod === 'POST';
    }
    
    /**
     * Check if this is a GET request
     */
    public function isGet(): bool
    {
        return $this->httpMethod === 'GET';
    }
    
    /**
     * Get POST data
     */
    public function post(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_POST;
        }
        
        return $_POST[$key] ?? $default;
    }
    
    /**
     * Get GET data
     */
    public function get(?string $key = null, $default = null)
    {
        if ($key === null) {
            return $_GET;
        }
        
        return $_GET[$key] ?? $default;
    }
    
    /**
     * Get all input data (GET + POST)
     */
    public function input(?string $key = null, $default = null)
    {
        $data = array_merge($_GET, $_POST);
        
        if ($key === null) {
            return $data;
        }
        
        return $data[$key] ?? $default;
    }
    
    /**
     * Debug info
     */
    public function debug(): array
    {
        return [
            'uri' => $this->uri,
            'path' => $this->path,
            'segments' => $this->segments,
            'controller' => $this->controller,
            'method' => $this->method,
            'params' => $this->params,
            'httpMethod' => $this->httpMethod
        ];
    }
}