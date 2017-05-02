<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 19:31
 */
class ControllerLogin extends Controller
{

    function actionValidate()
    {
        // проверка на существование данных, которые необходимо обработать

        if(!empty($_POST['username']) or !empty($_POST['password']) )
        {
            $userName = json_decode($_POST['username'], true);
            $userPassword = json_decode($_POST['password'], true);
            echo "<br> Username:"  . $userName;
            echo "<br> Username password:" . $userPassword;
            $response_array['status'] = 'success';
            echo "true";
            return json_encode($response_array);
        }
//       / if(!empty($_POST[]))
      //  $jsonUsername = json_decode($_POST);
      //  $jsonUsernamePassword = $_POST['password'];
     //   echo $jsonUsername;
       // echo $jsonUsernamePassword;
    }
    function actionIndex()
    {
     // echo "<br>ControllerLogin";
        $data[] = null;

        $this->view->generate('loginView.php', 'templateView.php', $data);
        echo "<br>ControllerLogin";
    }
}