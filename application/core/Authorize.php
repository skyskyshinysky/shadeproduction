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
    private $statusCookies;

    public function __construct()
    {
        include (ROOT . '/application/controllers/ControllerLogin.php');
        $this->controllerLogin = new ControllerLogin();
    }

    private function checkHash()
    {
        $userHash = $this->databaseInterface->getOne('SELECT userHash FROM users_password WHERE Id = ?s', $_COOKIE['Id']);
        // если хеши не сошлись
        if($userHash !== $_COOKIE['Hash']) {
            $this->controllerLogin->destroyCookie();
            return false;
        }
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
                    // редирект на страницу пользователя
                    echo "Redirect default page user";
                }
            }
            return;
        }
        if(isset($_COOKIE['Id']) and isset($_COOKIE['Hash']) or $this->statusCookies == true)
        {
            if(($this->statusCookies = $this->checkHash()) == true) {
                // оставляем на разбор роутеру
                echo "Run router";
            }
        }
        else {
            $routes = explode('/', $_SERVER['REQUEST_URI']);
            if(strcasecmp($routes[1], 'login') == 0) {
                return;
            }
            header("Location: http://www.shadeproduction.local/login");
            echo "<br> No authorize";
            echo '<br>' . $_SERVER['REQUEST_URI'];
        }
    }
}