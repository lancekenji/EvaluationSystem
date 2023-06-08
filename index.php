<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload classes
spl_autoload_register(function ($className) {
    $controllerFile = __DIR__ . '/controllers/' . $className . '.php';
    $modelFile = __DIR__ . '/models/' . $className . '.php';
    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    }
    if (file_exists($modelFile)) {
        require_once $modelFile;
    }
});

// Load routes
$routes = require_once __DIR__ . '/routes.php';

// Retrieve the requested route
$requestUri = $_SERVER['REQUEST_URI'];
$scriptName = $_SERVER['SCRIPT_NAME'];

// Remove query string parameters from the request URI, if any
if (($pos = strpos($requestUri, '?')) !== false) {
    $requestUri = substr($requestUri, 0, $pos);
}

// Find the corresponding controller and action for the requested route
if (isset($routes[$requestUri])) {
    [$controllerName, $action] = explode('@', $routes[$requestUri]);
    $controllerName = ucfirst($controllerName) . 'Controller';

    // Check if the controller class exists
    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        // Check if the action method exists in the controller
        if (method_exists($controller, $action)) {
            // Call the action method
            $controller->$action();
        } else {
            // Handle 404 Not Found error - Action method not found
            http_response_code(404);
            echo '404 Not Found - Action method not found';
            exit;
        }
    } else {
        // Handle 404 Not Found error - Controller class not found
        http_response_code(404);
        echo '404 Not Found - Controller class not found';
        exit;
    }
} else {
    // Handle 404 Not Found error - Route not found
    http_response_code(404);
    echo '404 Not Found - Route not found';
    exit;
}

// Function to load a view file
function loadView($viewPath, $data = [])
{
    extract($data);
    $viewFile = __DIR__ . '/views/' . $viewPath . '.php';
    if (file_exists($viewFile)) {
        require_once $viewFile;
    } else {
        // Handle 404 Not Found error - View file not found
        http_response_code(404);
        echo '404 Not Found - View file not found';
        exit;
    }
}
