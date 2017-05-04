<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 19:31
 */
class ControllerLogin extends Controller
{
    private $mail;
    public function destroyCookie()
    {
        setcookie("Id", "", time() - 3600*24*30*12, "/");
        setcookie("Hash", "", time() - 3600*24*30*12, "/");
    }
    public function setCookie($hash,$id)
    {
        setcookie("Id", $id, time()+60*60*24*30);
        setcookie("Hash", $hash, time()+60*60*24*30);
    }
    private function checkAuthorizeParameters()
    {
        $data['login_status'] = 'access_granted';
        $result = $this->databaseInterface->getRow('SELECT Id,statusActivation  FROM users WHERE userName = ?s', $_POST['userName']);
        if(!empty($result['Id']) and $result['statusActivation'] != null)
        {
            $userPassword = $this->databaseInterface->getOne('SELECT userPassword FROM users_password WHERE Id = ?s', $result['Id']);
            if(!empty($userPassword)) {
                if($userPassword === md5(md5($_POST['password']))) {
                    $hash = md5($this->databaseInterface->generateCode(10));
                    $this->databaseInterface->query('UPDATE users_password SET userHash = ?s',$hash);
                    $this->setCookie($hash,$result['Id']);
                } else {
                    $data['login_status'] = 'access_denied';
                    return array($data, false);
                }
            }
        } else {
            $data['login_status'] = 'access_denied';
            return array($data, false);
        }
        return array ($data, true);
    }
    private function checkCorrectParameters()
    {
        $data['signInStatus'] = null;
        $status = true;
        // проверяем длину Username
        if(strlen($_POST['userName']) < 3 or strlen($_POST['userName']) > 30){
            $data['signInStatus'] = "errorRangeUsername";
            $status = false;
        }
        // проверяем корректность email
        if(strcasecmp($_POST['email'],$_POST['reEnterEmail']) != 0) {
            $data['signInStatus'] = "errorCorrectEmail";
            $status = false;
        }
        // проверяем длину password
        if(strlen($_POST['password']) < 6 or strlen($_POST['password']) > 20){
            $data['signInStatus'] = "errorRangePassword";
            $status = false;
        }
        return array($data, $status);
    }
    function actionActivation()
    {
        $data['activationStatus'] = null;
        // проверяем параметр активации
        if(!empty($_GET['code']) && isset($_GET['code']))
        {
            // извлекаем уникальный номер пользователя
            $result = $this->databaseInterface->getRow("SELECT * FROM users WHERE activation = ?s", $_GET['code']);
            if(!empty($result) && $result['statusActivation'] != 1) {
                // обновляем статус регистрации пользователя
                $this->databaseInterface->query('UPDATE users SET statusActivation = 1');
                $data['activationStatus'] = 'activationCompletedSuccessfully';
            } else {
                $data['activationStatus'] = 'activationFailed';
            }
        }
        $this->view->generate('activationView.php', 'templateView.php', $data);
        echo "<br>ControllerLogin/actionActiovation";
    }
    function actionSignIn()
    {
        $data['signInStatus'] = null;
        // проверка на существование данных, которые необходимо обработать
        if(isset($_POST['firstName']) && !empty($_POST['firstName']) && isset($_POST['lastName']) &&
            !empty($_POST['lastName']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['reEnterEmail']) &&
            !empty($_POST['reEnterEmail']) && isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['password']) &&
            !empty($_POST['password']))
        {
            list ($data, $status) = $this->checkCorrectParameters();
            if($status == true){
                // попытка получения записи с заданным почтовым ящиком или ником
                $result = $this->databaseInterface->getOne("SELECT Id FROM users WHERE email = ?s OR username = ?s", $_POST['email'], $_POST['userName']);
                // если пользователя не существует
                if(empty($result)) {
                    //подключаем класс для подтверждения регистрации пользователя
                    require_once (ROOT . '/application/core/Mail/Mail.php');
                    //генерируем Id пользователя
                    $guid = $this->databaseInterface->guidv4();
                    //добавляем в таблицу и генерируем activation code
                    $activation=md5($_POST['email'].time());
                    $this->databaseInterface->query('INSERT INTO users (Id,firstName,lastName,userName,email,activation) VALUES(?s,?s,?s,?s,?s,?s)', $guid,
                        $_POST['firstName'], $_POST['lastName'], $_POST['userName'],  $_POST['email'],$activation);
                    //убираем лишние пробелы и делаем двойное шифрование
                    $password = md5(md5(trim($_POST['password'])));
                    //добавляем запись в таблицу
                    $this->databaseInterface->query('INSERT INTO users_password (Id, userPassword) VALUES(?s,?s)', $guid, $password);
                    // формируем электронное письмо подтверждения регистрации
                    $this->mail = new Mail();
                    $this->mail->to=$_POST['email'];
                    $this->mail->sendMail($activation);
                    // формируем статус регистрации
                    $data['signInStatus'] = "registrationCompletedSuccessfully";
                }
                else {
                    $data['signInStatus'] = "registrationFailed";
                }
            }
        }
        $this->view->generate('singInView.php', 'templateView.php', $data);
    }
    function actionIndex()
    {
        $data['login_status'] = null;
        if(isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['password']) && !empty($_POST['password']))
        {
            // проводим аутентификацию, если $status == true, то редиректим на дефолтную страницу пользователя
            list($data, $status) = $this->checkAuthorizeParameters();
            if($status == true) {
                echo "Redirect yopta";
                die();
                // редирект на дефолтную страницу пользователя
                header('Location: www.shadeproduction.local');
            }
        }
        $this->view->generate('loginView.php', 'templateView.php', $data);
    }
}