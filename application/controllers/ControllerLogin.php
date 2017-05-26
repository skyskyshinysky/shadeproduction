<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 19:31
 */
class ControllerLogin extends Controller
{
    public function setCookie($hash,$id)
    {
        setcookie("Id", $id, time()+60*60*24*30);
        setcookie("Hash", $hash, time()+60*60*24*30);
    }
    private function checkAuthorizeParameters()
    {
        $data['login_status'] = 'access_granted';
        $data['authorize'] = true;
        $result = $this->databaseInterface->getRow('SELECT *  FROM users WHERE userName = ?s', $_POST['userName']);
        if(!empty($result['Id']) and $result['statusActivation'] != null)
        {
            $userPassword = $this->databaseInterface->getOne('SELECT userPassword FROM users_password WHERE Id = ?s', $result['Id']);
            if(!empty($userPassword)) {
                if($userPassword === md5(md5($_POST['password']))) {
                    $data['userHash'] = $this->databaseInterface->getOne('SELECT userHash FROM users_password WHERE Id = ?s', $result['Id']);
                    $hash = md5($this->databaseInterface->generateCode(10));
                    $this->databaseInterface->query('UPDATE users_password SET userHash = ?s',$hash);
                    $this->setCookie($hash,$result['Id']);
                } else {
                    $data['login_status'] = 'access_denied';
                    $data['authorize'] = false;
                    return array($data, false, null);
                }
            }
        } else {
            $data['login_status'] = 'access_denied';
            $data['authorize'] = false;
            return array($data, false, null);
        }
        return array ($data, true, $result['typeAccount']);
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
        if(strlen($_POST['passwordUser']) < 6 or strlen($_POST['passwordUser']) > 20){
            $data['signInStatus'] = "errorRangePassword";
            $status = false;
        }
        return array($data, $status);
    }
    function actionActivation()
    {
        $data['activationStatus'] = null;
        $data['authorize'] = false;
        // проверяем параметр активации
        if(!empty($_GET['code']) && isset($_GET['code']))
        {
            // извлекаем уникальный номер пользователя
            $result = $this->databaseInterface->getRow("SELECT * FROM users WHERE activation = ?s", $_GET['code']);
            if(!empty($result) && $result['statusActivation'] != 1) {
                // обновляем статус регистрации пользователя
                $this->databaseInterface->query('UPDATE users SET statusActivation = 1');
                $data['activationStatus'] = 'activationCompletedSuccessfully';
                $data['authorize'] = false;
            } else {
                $data['activationStatus'] = 'activationFailed';
            }
        }
        $this->view->generate('activationView.php', 'templateView.php', $data);
    }
    function actionSignIn()
    {
        $data['signInStatus'] = null;
        $data['authorize'] = false;
        // проверка на существование данных, которые необходимо обработать
        if((isset($_POST['firstName']) && !empty($_POST['firstName']) && isset($_POST['lastName']) &&
            !empty($_POST['lastName'])) or isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['reEnterEmail']) &&
            !empty($_POST['reEnterEmail']) && isset($_POST['userName']) && !empty($_POST['userName']) && isset($_POST['passwordUser']) &&
            !empty($_POST['passwordUser']) && isset($_POST['typeAccount']) && !empty($_POST['typeAccount']))
        {
            if((is_string($_POST['typeAccount']) && strcasecmp($_POST['typeAccount'], 'user') == 0) or
                (is_string($_POST['typeAccount']) && strcasecmp($_POST['typeAccount'], 'band') == 0)){
            list ($data, $status) = $this->checkCorrectParameters();
            $data['authorize'] = false;
            if($status == true){
                // подключаем сервис работы с пользователем
                require_once (ROOT . '/application/services/UserService.php');
                $serviceUser = new UserService($this->databaseInterface);
                $data = $serviceUser->saveUser();
                $data['authorize'] = false;
            }
        }

        }
        $this->view->generate('singInView.php', 'templateView.php', $data);
    }
    function actionIndex()
    {
        $data['login_status'] = null;
        $data['authorize'] = false;
        // проверяем присутствие куков
        if($this->authorizeController->statusCookies == true) {
            // редиректим со страницы логина
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/');
        }
        if(isset($_POST['userName']) && !empty($_POST['userName']) && is_string($_POST['userName'])
            && isset($_POST['password']) && !empty($_POST['password']) && is_string($_POST['password']))
        {
            // проводим аутентификацию, если $status == true, то редиректим на дефолтную страницу пользователя в случае его парвого посещения
            // иначе выкидываем на мейнПейдж
            list($data, $status, $typeAccount) = $this->checkAuthorizeParameters();
            if($status == true and strcasecmp($typeAccount, 'user') == 0) {
                if($data['userHash'] == null) {
                    // редирект на дефолтную страницу пользователя
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/user/profile/' . $_POST['userName']);
                } else {
                    // если не первая авторизация, то редиректим на мейнпейдж
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/main');
                }
            } elseif ($status == true and strcasecmp($typeAccount, 'band') == 0) {
                // редирект на дефолтную страницу банды
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/user/profileBand/' . $_POST['userName']);
            }
        }
        $this->view->generate('loginView.php', 'templateView.php', $data);
    }
}