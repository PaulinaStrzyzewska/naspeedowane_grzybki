<?php

class Router {

    public function run() {

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $scriptDir = dirname($_SERVER['SCRIPT_NAME']);

        if ($scriptDir !== '/') {
            $uri = str_replace($scriptDir, '', $uri);
        }

        $uri = trim($uri, '/');

        $parts = $uri ? explode('/', $uri) : [];

        $controllerName = !empty($parts[0])
            ? ucfirst($parts[0]) . 'Controller'
            : 'HomeController';

        $action = $parts[1] ?? 'index';

        $param = $parts[2] ?? null;

        $controllerFile = BASE_PATH . "/app/controllers/$controllerName.php";

        if (!file_exists($controllerFile)) {
            $controllerName = 'HomeController';
            $action = 'index';
        }

        require_once $controllerFile;
        $controller = new $controllerName();

        if (!method_exists($controller, $action)) {
            $action = 'index';
        }

        // 🔴 KLUCZOWE
        if ($param !== null) {
            $controller->$action($param);
        } else {
            $controller->$action();
        }
    }
}
