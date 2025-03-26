<?php
session_start();

// Get controller and action from URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'sinhvien';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Convert controller name to proper case and append 'Controller'
$controllerName = ucfirst($controller) . 'Controller';

// Include the controller file
$controllerFile = 'controllers/' . $controllerName . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    
    // Create controller instance
    $controllerInstance = new $controllerName();
    
    // Start output buffering
    ob_start();
    
    // Call the action method
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        die('Action not found');
    }
    
    // Get the content
    $content = ob_get_clean();
    
    // Include the layout
    require_once 'views/layouts/main.php';
} else {
    die('Controller not found');
}
?> 