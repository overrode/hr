<?php
ini_set('error_reporting', E_ERROR);
// Session
session_start();

// Main app path
define('APP_PATH', dirname(realpath(__FILE__)) . '/app/');

// Include config
require_once APP_PATH . 'config/config.php';

define('APP_URL', $config['domain'] . $config['folder']);

// Setup auto-loader
spl_autoload_register('auto_loader');
function auto_loader($class) {
    if (FALSE !== strpos($class, '_')) {
        $tokens = explode('_', $class);
        if (file_exists(APP_PATH . implode('/', $tokens) . '.php')) {
            include APP_PATH . implode('/', $tokens) . '.php';
        }
    }
}

// Parse URL and determine current controller and action.
$url = $_SERVER['REQUEST_URI'];
if (0 === strpos($url, $config['folder'])) {
    $url = substr($url, strlen($config['folder']));
}

$tmp = array_reverse(explode('?', $url));
$url = array_pop($tmp);
$url = trim($url, '/');
$tokens = $url ? explode('/', $url) : array();

// Determin controller and action
$controller = $config['default_controller'];
$action = $config['default_action'];

// First argument in the URL, if exists, defines the controller
if (count($tokens) >= 1) {
    $controller = $tokens[0];
    $tokens = (count($tokens) > 1) ? array_slice($tokens, 1) : array();
}

// Second argument in the URL, if exists, defines the action
if (count($tokens) >= 1) {
    $action = $tokens[0];
    $tokens = (count($tokens) > 1) ? array_slice($tokens, 1) : array();
}

// Compiles controller class name
$controller_class = 'controller_' . $controller;

// Compiles action method name
$action_method = 'action_' . $action;

// Verifies if the controller class exists, if doesn't exist then the URL is invalid
if (!class_exists($controller_class)) {
    $controller = '404';
    $controller_class = 'controller_404';
    $action = 'index';
    $action_method = 'action_index';
}

// Instantiates the controller class
$controller_instance = new $controller_class;

// Verifies if the action method exists, if doesn't exist then the URL is invalid
if (!method_exists($controller_instance, $action_method)) {
    $controller = '404';
    $controller_class = 'controller_404';
    $controller_instance = new $controller_class;
    $action = 'index';
    $action_method = 'action_index';
}

// Go!
$params = [];
$controller_instance->$action_method($params);

model_user::create_csv_string();