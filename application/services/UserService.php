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
        $modelUser->about = $result['about'];
        return $modelUser;
    }
    public function getSongs($genreMusic) {
        return $this->databaseInterface->getAll('SELECT music.nameMusic, music.pathFile,users.bandName FROM  music,users WHERE music.bandId = users.Id AND music.genreMusic = ?s ORDER BY music.time DESC LIMIT 10', $genreMusic);
    }
    public function getBands($genreMusic) {
        return $this->databaseInterface->getAll('SELECT users.userName, users.genreMusic, users.bandName,
           logo.nameLogo, logo.pathFile FROM  users,logo WHERE users.genreMusic = ?s AND users.typeAccount = "band" AND 
           users.Id = logo.Id ORDER BY time  DESC LIMIT 10', $genreMusic);
    }
    function editAboutBand($message) {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $this->databaseInterface->query('UPDATE users SET about=?s  WHERE userName=?s', $message, $modelUser->userName);
    }
    function editSkypeBand($message) {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $this->databaseInterface->query('UPDATE users SET skype=?s  WHERE userName=?s', $message, $modelUser->userName);
    }
    function editInstagramBand($message) {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $this->databaseInterface->query('UPDATE users SET instagram=?s  WHERE userName=?s', $message, $modelUser->userName);
    }
    function editFacebookBand($message) {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $this->databaseInterface->query('UPDATE users SET facebook=?s  WHERE userName=?s', $message, $modelUser->userName);
    }
    function editWebsiteBand($message) {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $this->databaseInterface->query('UPDATE users SET website=?s  WHERE userName=?s', $message, $modelUser->userName);
    }
    function editTwitterBand($message) {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $this->databaseInterface->query('UPDATE users SET twitter=?s  WHERE userName=?s', $message, $modelUser->userName);
    }
    function editPhoneBand($message) {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $this->databaseInterface->query('UPDATE users SET phone=?s  WHERE userName=?s', $message, $modelUser->userName);
    }
    public function editBand($nameBand,$genreMusic)
    {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $modelUser->bandName = $nameBand;
        $modelUser->genreMusic = $genreMusic;
        $this->updateUser($modelUser);
    }
    public function updateUser($modelUser)
    {
        $this->databaseInterface->query('UPDATE users SET email=?s ,genreMusic=?s, bandName=?s WHERE userName=?s',$modelUser->email, $modelUser->genreMusic, $modelUser->bandName, $modelUser->userName);
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
            $password = md5(md5(trim($_POST['passwordUser'])));
            //добавляем запись в таблицу
            $this->databaseInterface->query('INSERT INTO users_password (Id, userPassword) VALUES(?s,?s)', $guid, $password);
            //добавляем 404логотип
            require_once (ROOT . '/application/services/ImageService.php');
            $imagesSevice = new ImageService($this->databaseInterface);
            $imagesSevice->save404Logo($guid);
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