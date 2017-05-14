<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 16:55
 */
class Authorize
{
    public $databaseInterface;
    private $controllerLogin;
    public $statusCookies;
    public $username;
    public $typeAccount;

    public function __construct()
    {
        require_once (ROOT . '/application/controllers/ControllerLogin.php');
        $this->controllerLogin = new ControllerLogin();
        $this->statusCookies = false;
    }
    public function destroyCookie()
    {
        setcookie("Id", "", time() - 3600*24*30*12, "/");
        setcookie("Hash", "", time() - 3600*24*30*12, "/");
    }
    private function checkHash()
    {
        $userHash = $this->databaseInterface->getOne('SELECT userHash FROM users_password WHERE Id = ?s', $_COOKIE['Id']);
        // если хеши не сошлись
        if($userHash !== $_COOKIE['Hash']) {
            $this->destroyCookie();
            return false;
        }
        // вытаскиваем Username и тип аккаунта для построения шаблона вьюхи
        $result= $this->databaseInterface->getRow('SELECT userName,typeAccount FROM users WHERE Id = ?s', $_COOKIE['Id']);
        $this->username = $result['userName'];
        $this->typeAccount = $result['typeAccount'];
        return true;
    }
    /**
     * @param $interface - class CRUD
     */
    function checkAuthorize($interface)
    {
        $this->databaseInterface = &$interface;
        // проверяем на страницу по умолчанию
        if(strcasecmp($_SERVER['REQUEST_URI'], '/') == 0)
        {
            // проверяем куки, если есть, то редиректим на страницу пользователя
            if(isset($_COOKIE['Id']) and isset($_COOKIE['Hash']))
            {
                if(($this->statusCookies = $this->checkHash()) == true) {
                    // редирект на страницу пользователя, где далее маршрут будет разбирать роутер
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/main');
                }
            }
            else {
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/main/welcome');
            }
            return;
        }
        if(isset($_COOKIE['Id']) and isset($_COOKIE['Hash']) or $this->statusCookies == true)
        {
            if(($this->statusCookies = $this->checkHash()) == true) {
                // оставляем на разбор роутеру
                return;
            }
        }
        else
        {
            // получаем маршрут, если в маршруте уже на логин, то отдаем на разбор роутеру
            $routes = explode('/', $_SERVER['REQUEST_URI']);
            if(strcasecmp($routes[1], 'login') == 0 or strcasecmp($routes[1], 'main') == 0) {
                return;
            }
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
        }
    }
}