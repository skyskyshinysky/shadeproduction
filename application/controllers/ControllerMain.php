<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 03.05.2017
 * Time: 0:25
 */
class ControllerMain extends Controller
{
    function actionIndex()
    {
       $data=null;
       $this->view->generate('mainView.php', 'templateView.php', $data);
    }
    function actionWelcome()
    {
        $data[] = null;
        if($this->authorizeController->statusCookies == true) {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
        }
        $this->view->generate('welcomeView.php', 'templateView.php', $data);
    }
}