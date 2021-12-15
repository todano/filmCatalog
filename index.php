<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
require_once 'vendor/autoload.php';

DEFINE('BASE_URL','/PHPoop/catalog/');
DEFINE('DEFAULT_CONTROLLER','Main');
DEFINE('DEFAULT_METHOD','index');
DEFINE('BASE_PATH',__DIR__);
DEFINE('CONTROLLER_PATH',BASE_PATH.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR);
// require_once 'db.php';
//
//
// $users = new CreateSQL();
// connect('localhost','catalog','todano','todanopak');
// $users->select('users')->get();


// echo password_hash('4321',PASSWORD_DEFAULT);
$url = $_SERVER['REQUEST_URI'];
$url = str_replace(BASE_URL,'',$url);
$urlParts = array_filter(explode('/',$url));
$controller = $urlParts[0] ?? DEFAULT_CONTROLLER;
$controller = ucFirst(strtolower($controller));
$controllerFile = $controller.'.php';
// echo '<pre>'; print_r($controller);  die;
$method = $urlParts[1] ?? DEFAULT_METHOD;
unset($urlParts[0],$urlParts[1]);
if(!file_exists(CONTROLLER_PATH.$controllerFile))
{
  $controller = DEFAULT_CONTROLLER;
}
$initController = "Tod\\Controllers\\".$controller;
$app = new $initController();
echo '<pre>'; print_r($app); 

// if method exist, da se izvika suotvetniq method ako ne sushtestvyva se vika
// methoda po podrazbirane i
 call_user_func_array(array($app, $method), $urlParts);
