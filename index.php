<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('WWW_ROOT', __DIR__ . DS);

$routes = array(

    
    'home' => array(
        'controller' => 'dashboard',
        'action' => 'index'
    ),
        'dashboard' => array(
            'controller' => 'dashboard',
            'action' => 'dashboard'
        ),
        'login' => array(
            'controller' => 'dashboard',
            'action' => 'login'
            ),
        'logout' => array(
            'controller' => 'dashboard',
            'action' => 'logout'
            ),
        'register' => array(
            'controller' => 'dashboard',
            'action' => 'register'
            ),
        'delete' => array(
            'controller' => 'dashboard',
            'action' => 'delete'
            ),

    'week' => array(
        'controller' => 'Week',
        'action' => 'week'
    ),
        'weken' => array(
            'controller' => 'Week',
            'action' => 'weken'
        ),

    'kinderen' => array(
       'controller' => 'kinderen',
       'action' => 'gegevens'
    ),
        'voegtoe' => array(
           'controller' => 'kinderen',
           'action' => 'toevoegen'
        ),
        'weizig' => array(
           'controller' => 'kinderen',
           'action' => 'weizigen'
        ),



    'old_home' => array(
        'controller' => 'Staf',
        'action' => 'index'
    ),
        'staf' => array(
            'controller' => 'Staf',
            'action' => 'staf'
        ),
        'add' => array(
            'controller' => 'Staf',
            'action' => 'add'
        )
    
);

if(empty($_GET['page'])) {
    $_GET['page'] = 'home';
}
if(empty($routes[$_GET['page']])) {
    header('Location: index.php');
    exit();
}

$route = $routes[$_GET['page']];
$controllerName = $route['controller'] . 'Controller';

require_once WWW_ROOT . 'controller' . DS . $controllerName . ".php";

$controllerObj = new $controllerName();
$controllerObj->route = $route;
$controllerObj->filter();
$controllerObj->render();