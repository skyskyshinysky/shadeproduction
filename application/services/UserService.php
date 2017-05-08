<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 04.05.2017
 * Time: 21:20
 */
class UserService
{
    private $databaseInterface;
    private $mail;

    function __construct($interface)
    {
        $this->databaseInterface = $interface;
    }
    public function getUser($userName = null)
    {
        if($userName == null) {
            $userName = $this->databaseInterface->getRow('SELECT userName FROM users WHERE Id = ?s', $_COOKIE['Id']);
        }
        $modelUser = new ModelUser($userName);
        $result = $this->databaseInterface->getRow('SELECT * FROM users WHERE userName = ?s', $modelUser->userName);
        if(strcasecmp($result['typeAccount'], 'user') != 0) {
            return null;
        }
        $modelUser->id = $result['Id'];
        $modelUser->firstName = $result['firstName'];
        $modelUser->lastName = $result['lastName'];
        $modelUser->email = $result['email'];
        $modelUser->bandName = $result['bandName'];
        $modelUser->genreMusic = $result['genreMusic'];
        return $modelUser;
    }
    public function getBand($userName)
    {
        if($userName == null) {
            return null;
        }
        $modelUser = new ModelUser($userName);
        $result = $this->databaseInterface->getRow('SELECT * FROM users WHERE userName = ?s', $modelUser->userName);
        if($result == null) {
            return null;
        }
        $modelUser->id = $result['Id'];
        $modelUser->bandName = $result['bandName'];
        $modelUser->email = $result['email'];
        $modelUser->genreMusic = $result['genreMusic'];
        return $modelUser;
    }
    public function renameBand($nameBand)
    {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $modelUser->bandName = $nameBand;
        $this->updateUser($modelUser);
    }
    public function updateUser($modelUser)
    {
        $this->databaseInterface->query('UPDATE users SET email=?s ,genreMusic=?s, bandName=?s',$modelUser->email, $modelUser->genreMusic, $modelUser->bandName);
    }
    public function getNameUser()
    {
        return $this->getUser()->userName;
    }
    public function saveUser()
    {
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
            $this->databaseInterface->query('INSERT INTO users (Id,firstName,lastName,userName,email,activation,typeAccount) VALUES(?s,?s,?s,?s,?s,?s,?s)', $guid,
                $_POST['firstName'], $_POST['lastName'], $_POST['userName'],  $_POST['email'],$activation, $_POST['typeAccount']);
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
        return $data;
    }
}