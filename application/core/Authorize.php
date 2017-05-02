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


    /**
     * @param $interface - class CRUD
     */
    function checkAuthorize($interface)
    {
        $databaseInterface = &$interface;

        if(isset($_COOKIE['id']) and isset($_COOKIE['hash']))
        {
            echo "Authorize";
        }
        else {
            $routes = explode('/', $_SERVER['REQUEST_URI']);
            if(strcasecmp($routes[1], 'login') == 0) {
                return;
            }
            header("Location: ./login");
            echo "<br> No authorize";
            echo '<br>' . $_SERVER['REQUEST_URI'];
        }
        $data = $databaseInterface->getOne('SELECT * FROM test');
        echo '<br>' . $data;
    }
}