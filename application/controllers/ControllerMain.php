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
        switch ($_POST['parameterSearching']) {
            case 'Genre Music':
                echo json_encode($this->databaseInterface->getAll('SELECT nameMusic, genreMusic FROM music WHERE nameMusic LIKE ?s OR genreMusic LIKE ?s LIMIT 15',
                    $_POST['searchString'], $_POST['searchString']));
                break;
            case 'Users':
                echo json_encode($this->databaseInterface->getAll('SELECT firstName, lastName, userName FROM users WHERE userName LIKE ?s OR firstName LIKE ?s OR lastName LIKE ?s LIMIT 15',
                    $_POST['searchString'], $_POST['searchString'], $_POST['searchString']));
                break;
            case 'Bands':
                echo json_encode($this->databaseInterface->getAll('SELECT bandName,userName FROM users WHERE typeAccount = ?s AND userName LIKE ?s OR bandName LIKE ?s LIMIT 15', "band",
                    $_POST['searchString'], $_POST['searchString']));
                break;

        }
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