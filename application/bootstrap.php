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

    // подключаем CRUD и класс, отвечающий за авторизацию
    require_once (ROOT . '/application/core/DAL/MySQLInterface.php');
    require_once (ROOT . '/application/core/Authorize.php');

    // создаем объект класса CRUD и контроллер проверки авторизации пользователя
    $interfaceDatabase = new MySQLInterface();
    $authorize = new Authorize();
    //вызов проверки авторизации пользователя
    $authorize->checkAuthorize($interfaceDatabase);
    //Создаем объект класса Router
    //Вызываем метод run
    $router = new Router();
    $router->run($interfaceDatabase);