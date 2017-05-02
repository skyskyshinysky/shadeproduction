<?php
/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 16:01
 */
    //Подключаем файлы ядра
    require_once (ROOT . '/application/core/Model.php');
    require_once (ROOT . '/application/core/Controller.php');
    require_once (ROOT . '/application/core/View.php');
    require_once (ROOT . '/application/core/Router.php');


    //
    //Создаем объект класса Router
    //Вызываем метод run
    $router = new Router();
    $router->run();