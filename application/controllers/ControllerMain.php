<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 03.05.2017
 * Time: 0:25
 */
class ControllerMain extends Controller
{
    function actionSearchBox()
    {
        $searchString = $_POST["searchString"];
        $data['music'] =  $this->databaseInterface->getAll('SELECT nameMusic, genreMusic FROM music WHERE nameMusic LIKE ?s LIMIT 15', "%$searchString%");
        $data['bands'] = $this->databaseInterface->getAll('SELECT userName,bandName,genreMusic FROM users WHERE bandName LIKE ?s LIMIT 15', "%$searchString%");
        echo json_encode($data);
    }
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