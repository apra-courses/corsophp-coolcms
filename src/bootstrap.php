<?php
define('ROOT_DIR', __DIR__ . '/..');
define('SRC_DIR', __DIR__);
define('CFG_DIR', ROOT_DIR . '/config');
define('PUBLIC_DIR', __DIR__ . '/../public');
define('CONTROLLER_DIR', SRC_DIR . '/controller');
define('MODEL_DIR', SRC_DIR . '/model');
define('VIEW_DIR', SRC_DIR . '/view');
define('REPOSITORY_DIR', SRC_DIR . '/repository');

require ROOT_DIR . '/vendor/autoload.php';

session_start();

$controllerMap = array(
    '/' => 'FrontendController',
    '/admin' => 'BackendController'
);

$pathInfo = App::getInstance()->getPathInfo();
$action = App::getInstance()->getAction();

if (!isset($controllerMap[$pathInfo])) {
    die("Controller non definito per $pathInfo");  
}

try {
    $controllerClass = $controllerMap[$pathInfo];    
    $controller = new $controllerClass();
    if (!is_callable(array($controller, $action))) {
        die("Action: $action non prevista per il controller: $controllerClass");  
    }
    $controller->$action();        
} catch (Exception $ex) {
    die($ex->getMessage());    
}    