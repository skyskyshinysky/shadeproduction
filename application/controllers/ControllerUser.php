<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 04.05.2017
 * Time: 13:25
 */
class ControllerUser extends Controller
{
    function actionProfile() {
        $data = null;
        require_once(ROOT . '/application/services/UserService.php');
        $userService = new UserService($this->databaseInterface);
        if(isset($_GET['userNameDefaultPage']) and $this->authorizeController->statusCookies == true)
        {
            $this->model = $userService->getUser($_GET['userNameDefaultPage']);
        }
        $data = $this->model->getDataUser();
        $this->view->generate('userView.php', 'templateView.php', $data);
    }
    function actionLogout()
    {
        $this->authorizeController->destroyCookie();
        header('Location: http://' . $_SERVER['HTTP_HOST']);
    }
    function actionIndex()
    {
        echo 'actionIndex';
    }
}