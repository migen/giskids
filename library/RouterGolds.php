<?php

/**
 * Simple Router for static website pages
 */
class Router
{
    private static array $routes = [
        '' => 'home',
        'home' => 'home',
        'about' => 'about',
        'products' => 'products',
        'features' => 'features',
        'gold-standards' => 'gold-standards',
        'contact' => 'contact',
        'terms' => 'terms',
        'privacy' => 'privacy'
    ];
    
    public static function route(Request $request): void
    {
        $path = trim($request->path, '/');
        
        // Check if route exists
        if (isset(self::$routes[$path])) {
            $view = self::$routes[$path];
            $viewPath = BASE_PATH . '/views/website/' . $view . '.php';
            
            if (file_exists($viewPath)) {
                // Set proper content type header before any output
                if (!headers_sent()) {
                    header('Content-Type: text/html; charset=UTF-8');
                }
                
                // Include the layout
                $layoutPath = BASE_PATH . '/views/layouts/app.php';
                if (file_exists($layoutPath)) {
                    require $layoutPath;
                } else {
                    // If no layout, just include the view directly
                    require $viewPath;
                }
            } else {
                self::notFound();
            }
        } else {
            self::notFound();
        }
    }
    
    private static function notFound(): void
    {
        if (!headers_sent()) {
            http_response_code(404);
            header('Content-Type: text/html; charset=UTF-8');
        }
        
        $errorPath = BASE_PATH . '/views/errors/404.php';
        if (file_exists($errorPath)) {
            require $errorPath;
        } else {
            echo '<!DOCTYPE html><html><head><title>404 Not Found</title></head>';
            echo '<body><h1>404 - Page Not Found</h1></body></html>';
        }
        exit;
    }
}