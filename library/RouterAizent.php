<?php

/**
 * Dynamic Router with priority-based routing logic
 * Routes are checked in priority order: website, auth, special
 * Falls back to dynamic controller/method routing
 */
class Router
{
    private static array $websiteRoutes = [
        'home' => ['controller' => 'Website', 'method' => 'home'],
        'about' => ['controller' => 'Website', 'method' => 'about'],
        'products' => ['controller' => 'Website', 'method' => 'products'],
        'features' => ['controller' => 'Website', 'method' => 'features'],
        'gold-standards' => ['controller' => 'Website', 'method' => 'giskidstandards'],
        'contact' => ['controller' => 'Contact', 'method' => 'index'],
        'privacy' => ['controller' => 'Website', 'method' => 'privacy'],
        'terms' => ['controller' => 'Website', 'method' => 'terms'],
        'documentation' => ['controller' => 'Website', 'method' => 'documentation'],
    ];
    
    private static array $authRoutes = [
        'login' => ['controller' => 'Auth', 'method' => 'login'],
        'logout' => ['controller' => 'Auth', 'method' => 'logout'],
        'register' => ['controller' => 'Auth', 'method' => 'register'],
        'forgot-password' => ['controller' => 'Auth', 'method' => 'forgotPassword'],
        'reset-password' => ['controller' => 'Auth', 'method' => 'resetPassword'],

        'auth/google/redirect' => ['controller' => 'OAuth', 'method' => 'index'],
        'auth/google/callback' => ['controller' => 'OAuth', 'method' => 'index'],
        'auth/google/link' => ['controller' => 'OAuth', 'method' => 'index'],
        'auth/google/unlink' => ['controller' => 'OAuth', 'method' => 'index'],

        'auth/facebook/redirect' => ['controller' => 'OAuth', 'method' => 'index'],
        'auth/facebook/callback' => ['controller' => 'OAuth', 'method' => 'index'],
        'auth/facebook/link' => ['controller' => 'OAuth', 'method' => 'index'],
        'auth/facebook/unlink' => ['controller' => 'OAuth', 'method' => 'index'],

    ];
    
    private static array $specialRoutes = [
        'dashboard' => ['controller' => 'Dashboard', 'method' => 'index'],
        'admin' => ['controller' => 'Admin', 'method' => 'index'],
    ];
    
    public static function route(Request $request): void
    {
        // Handle empty/root request
        if (empty($request->controller)) {
            self::dispatch('Website', 'home', []);
            return;
        }
        
        $path = $request->path;
        $controller = $request->controller;
        $method = $request->method ?: 'index';
        $params = $request->params;
        

        /**
         * Check route groups (website, auth, special) in priority order.
         * Dispatch if a matching route is found.
         */
        $routeGroups = [
            'website' => self::$websiteRoutes,
            'auth' => self::$authRoutes,
            'special' => self::$specialRoutes,
        ];

        foreach ($routeGroups as $group => $routes) {
            if (isset($routes[$path])) {
                $route = $routes[$path];
                self::dispatch($route['controller'], $route['method'], $params);
                return;
            }
        }

        // Dynamic controller/method routing
        // /controller/method/param1/param2...
        self::dispatch(ucfirst($controller), $method, $params);
    }
    
    private static function dispatch(string $controller, string $method, array $params = []): void
    {
        $controllerFile = BASE_PATH . "/controllers/{$controller}Controller.php";
        
        if (!file_exists($controllerFile)) {
            self::notFound("Controller not found: {$controller}Controller");
            return;
        }
        
        require_once $controllerFile;
        $controllerClass = "{$controller}Controller";
        
        if (!class_exists($controllerClass)) {
            self::notFound("Controller class not found: {$controllerClass}");
            return;
        }
        
        $instance = new $controllerClass();
        
        if (!method_exists($instance, $method)) {
            self::notFound("Method not found: {$controllerClass}::{$method}");
            return;
        }
        
        try {
            // Call method with params
            if (!empty($params)) {
                $instance->$method($params);
            } else {
                $instance->$method();
            }
        } catch (Exception $e) {
            error_log("Router dispatch error: " . $e->getMessage());
            self::error500("Internal server error");
        }
    }
    
    private static function notFound(string $message = "Page not found"): void
    {
        http_response_code(404);
        
        // Try to load a 404 controller/view
        $notFoundFile = BASE_PATH . "/controllers/ErrorController.php";
        if (file_exists($notFoundFile)) {
            require_once $notFoundFile;
            if (class_exists('ErrorController')) {
                $controller = new ErrorController();
                if (method_exists($controller, 'notFound')) {
                    $controller->notFound();
                    return;
                }
            }
        }
        
        // Use the 404 view
        $viewFile = BASE_PATH . '/views/errors/404.php';
        if (file_exists($viewFile)) {
            $debug = null;
            if (($_ENV['APP_DEBUG'] ?? false) && $_SERVER['REQUEST_URI'] ?? '') {
                $debug = "Requested URL: " . $_SERVER['REQUEST_URI'];
            }
            include $viewFile;
        } else {
            // Emergency fallback
            echo "404 - Page Not Found";
        }
    }
    
    /**
     * Handle 500 server errors
     */
    private static function error500(string $message = "Internal server error"): void
    {
        http_response_code(500);
        
        // Use the 500 view
        $viewFile = BASE_PATH . '/views/errors/500.php';
        if (file_exists($viewFile)) {
            $debug = null;
            if (($_ENV['APP_DEBUG'] ?? false)) {
                $debug = $message;
            }
            include $viewFile;
        } else {
            // Emergency fallback
            echo "500 - Server Error";
        }
    }
    
    /**
     * Debug routing info
     */
    public static function debug(Request $request): array
    {
        return [
            'request' => [
                'path' => $request->path,
                'controller' => $request->controller,
                'method' => $request->method,
                'params' => $request->params
            ],
            'websiteRoutes' => self::$websiteRoutes,
            'authRoutes' => self::$authRoutes,
            'specialRoutes' => self::$specialRoutes,
        ];
    }
}