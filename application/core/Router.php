<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 16:08
 */
class Router
{
    function __construct()
    {

    }

    function run($interface, $authorizeController)
    {
        // контроллер и действие по умолчанию
        $controllerName = 'Main';
        $actionName = 'index';

        $routes = explode('/', $_SERVER['REQUEST_URI']);
        // получаем имя контроллера
        if ( !empty($routes[1]) )
        {
            $controllerName = $routes[1];
        }
        // получаем имя экшена
        if ( !empty($routes[2]) )
        {
            $actionName = $routes[2];
        }
        // получаем префиксы
        $modelName = 'Model' . ucfirst($controllerName);
        $controllerName = 'Controller' . ucfirst($controllerName);
        $actionName = 'action'. ucfirst($actionName);

        // выводим сформированные данные для отладки
        //echo "<br>Name Controller: ". $controllerName;
        //echo "<br>Action : " . $actionName;
        //echo "<br>Model : " . $modelName;
        // подключаем файл с классом модели (его может и не быть, это некритично)
        $modelFile = strtolower($modelName) . '.php';
        $modelPath = ROOT . '/application/models/' . $modelFile;
        if(file_exists($modelPath)) {
            require_once ($modelPath);
        }
        // подключаем файл с классом контроллера (должен быть всегда)
        $controllerFile = strtolower($controllerName) . '.php';
        $controllerPath = ROOT . '/application/controllers/' . $controllerFile;
        if(file_exists($controllerPath)) {
            require_once ($controllerPath);
        }
        else {
            //редирект на 404
            $this->ErrorPage404();
        }
        $controller = new $controllerName;
        $action = $actionName;

        //проверяем существование метода у контроллера
        if(method_exists($controller, $action)) {
            //вызова метода контроллера
            $controller->databaseInterface = $interface;
            $controller->authorizeController = $authorizeController;
            $controller->$action();
        } else {
            //редирект на 404
            $this->ErrorPage404();
        }
    }
    function errorPage404()
    {
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        header("HTTP/1.0 404 Not Found");
        header("HTTP/1.1 404 Not Found");
        header("Status: 404 Not Found");
     //   header('HTTP/1.1 404 Not Found');
     //   header("Status: 404 Not Found");
        die();
       // header('Location:' . $host . '404');
    }
}