<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 03.05.2017
 * Time: 0:25
 */
class ControllerMain extends Controller
{
    function actionSearchBoxPeople(){
        $searchString = $_POST["searchString"];
        $data['people'] =  $this->databaseInterface->getAll('SELECT firstName, lastName, userName FROM users WHERE firstName LIKE ?s  OR lastName LIKE ?s LIMIT 15',
            "%$searchString%", "%$searchString%");
        echo json_encode($data);
    }
    function actionPeople(){
        $data = null;
        $this->view->generate('peopleView.php', 'templateView.php', $data);
    }
    function actionSearchBox(){
        $searchString = $_POST["searchString"];
        $data['music'] =  $this->databaseInterface->getAll('SELECT music.nameMusic, music.genreMusic, users.userName FROM music, users WHERE music.bandId = users.Id AND music.nameMusic LIKE ?s  LIMIT 15', "%$searchString%");
        $data['bands'] = $this->databaseInterface->getAll('SELECT userName,bandName,genreMusic FROM users WHERE bandName LIKE ?s LIMIT 15', "%$searchString%");
        echo json_encode($data);
    }
    function actionIndex(){
       $data['authorize'] = false;
       if($this->authorizeController->statusCookies == true) {
           $data['authorize'] = true;
           $data['userName'] = $this->authorizeController->username;
           $data['typeAccount'] = $this->authorizeController->typeAccount;
           $this->view->generate('mainView.php', 'templateView.php', $data);
           return;
       }
       $this->view->generate('404View.php', 'templateView.php', $data);
    }
    function actionWelcome(){
        $data['authorize'] = false;
        if($this->authorizeController->statusCookies == true) {
            header('Location: http://' . $_SERVER['HTTP_HOST']);
        }
        $this->view->generate('welcomeView.php', 'templateView.php', $data);
    }
}