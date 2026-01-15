<?php

class Router{
  public function run(){
    $url = $_GET['url'] ?? '';
    $parts = explode("/", trim($url, "/"));

    $controllerName = ucfirst($parts[0] ?? 'home') . 'Controller';
    $action = $parts[1] ?? 'showView';

    $controllerFile = "../app/controllers/".$controllerName.".php";

    if(!file_exists($controllerFile)){
      die('404');
    }

    require_once $controllerFile;
    $controller = new $controllerName();

    if(!method_exists($controller, $action)){
      die('404');
    }

    $controller->$action();
  }
}