<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 19:31
 */
class ControllerLogin extends Controller
{
    function actionSignIn()
    {
        $data['signInStatus'] = null;
        // проверка на существование данных, которые необходимо обработать
        if(isset($_POST['firstName']) && !empty($_POST['firstName']) && isset($_POST['lastName']) &&
            !empty($_POST['lastName']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['reEnterEmail']) &&
            !empty($_POST['reEnterEmail']) && isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['password']) &&
            !empty($_POST['password']))
        {
            // попытка получения записи с тзаданным почтовым ящиком или ником
            $result = $this->databaseInterface->getOne("SELECT Id FROM users WHERE email = ?s OR username = ?s", $_POST['email'], $_POST['userName']);

            if(empty($result)) {
                //подключаем класс для подтверждения регистрации пользователя
                require_once (ROOT . '/application/core/Mail/Mail.php');
                //генерируем Id пользователя
                $guid = $this->databaseInterface->guidv4();
                //добавляем в таблицу и генерируем activation code
                $activation=md5($_POST['email'].time());
                $this->databaseInterface->query('INSERT INTO users (Id,firstName,lastName,userName,email,activation) VALUES(?s,?s,?s,?s,?s,?s)', $guid,
                    $_POST['firstName'], $_POST['lastName'], $_POST['userName'],  $_POST['email'],$activation);
                $to=$_POST['email'];
                $mail = new Mail();
                $mail->sendMail($to,$activation);
                $data['signInStatus'] = "registrationCompletedSuccessfully";
            }
            else {
                $data['signInStatus'] = "registrationFailed";
            }
        }
        $this->view->generate('singInView.php', 'templateView.php', $data);
    }
    function actionIndex()
    {
        $data[] = null;

        $this->view->generate('loginView.php', 'templateView.php', $data);
        echo "<br>ControllerLogin";
    }
}