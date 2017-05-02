<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 19:31
 */
class ControllerLogin extends Controller
{
    function actionIndex()
    {
        echo "<br>ControllerLogin";
        $data = null;

        $this->view->generate('loginView.php', 'templateView.php', $data);
    }
}