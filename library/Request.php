<?php

/**
 * Lean Request class - parses URL into controller, method, and params
 * Single responsibility: URL parsing for routing
 */
class Request
{
    public string $controller = '';
    public string $method = '';
    public array $params = [];
    public string $path = '';
    
    public function __construct()
    {
        $this->parseRequest();
    }
    
    private function parseRequest(): void
    {
        // Get the request URI and remove query string
        $uri = trim($_SERVER['REQUEST_URI'] ?? '/', '/');
        $path = parse_url('/' . $uri, PHP_URL_PATH);
        $this->path = trim($path, '/');
        
        // Split path into segments
        $segments = $this->path ? explode('/', $this->path) : [];
        
        // Parse controller, method, and params from URL segments
        if (count($segments) >= 1) {
            $this->controller = $segments[0];
        }
        
        if (count($segments) >= 2) {
            $this->method = $segments[1];
        }
        
        if (count($segments) > 2) {
            $this->params = array_slice($segments, 2);
        }



        
    }
}