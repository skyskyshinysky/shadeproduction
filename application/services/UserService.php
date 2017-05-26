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
    public function getUser($userName = null){
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
        $modelUser->about = $result['about'];
        $modelUser->skype = $result['skype'];
        $modelUser->twitter = $result['twitter'];
        $modelUser->instagram = $result['instagram'];
        $modelUser->facebook = $result['facebook'];
        $modelUser->website = $result['website'];
        $modelUser->origin = $result['origin'];
        $modelUser->yearsActive = $result['yearsActive'];
        $modelUser->genreMusic = $result['genreMusic'];
        $modelUser->male = $result['male'];
        $modelUser->city = $result['city'];
        $modelUser->language = $result['language'];
        return $modelUser;
    }

    public function getBand($userName){
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
        $modelUser->skype = $result['skype'];
        $modelUser->twitter = $result['twitter'];
        $modelUser->instagram = $result['instagram'];
        $modelUser->facebook = $result['facebook'];
        $modelUser->website = $result['website'];
        $modelUser->origin = $result['origin'];
        $modelUser->yearsActive = $result['yearsActive'];
        return $modelUser;
    }
    public function getSongs($genreMusic) {
        return $this->databaseInterface->getAll('SELECT music.nameMusic, music.pathFile,users.bandName FROM  music,users WHERE music.bandId = users.Id AND music.genreMusic = ?s ORDER BY music.time DESC LIMIT 10', $genreMusic);
    }
    public function getPeople() {
        return $this->databaseInterface->getAll('SELECT users.firstName,users.lastName,users.userName,
            logo.nameLogo, logo.pathFile FROM users,logo WHERE users.typeAccount = "user" 
            AND logo.Id = users.Id ORDER BY time DESC LIMIT 10');
    }
    public function getBands($genreMusic) {
        return $this->databaseInterface->getAll('SELECT users.userName, users.genreMusic, users.bandName,
           logo.nameLogo, logo.pathFile FROM  users,logo WHERE users.genreMusic = ?s AND users.typeAccount = "band" AND 
           users.Id = logo.Id ORDER BY time  DESC LIMIT 10', $genreMusic);
    }
    public function updateInformationUser() {
        $this->databaseInterface->query('UPDATE users SET firstName = ?s, lastName = ?s, male = ?s, email = ?s, about = ?s, skype = ?s, twitter = ?s, instagram = ?s,
            facebook = ?s,website = ?s, city = ?s, language = ?s WHERE  Id = ?s',
            $_POST['firstName'], $_POST['lastName'], $_POST['male'], $_POST['email'],$_POST['aboutUser'], $_POST['skype'],$_POST['twitter'],$_POST['instagram'], $_POST['facebook'],
            $_POST['website'],$_POST['hometown'], $_POST['language'], $_COOKIE['Id']);
    }
    public function updateInformationBand(){
        $this->databaseInterface->query('UPDATE users SET bandName = ?s, genreMusic = ?s,email = ?s,about = ?s,skype = ?s,twitter = ?s,instagram = ?s,
            facebook = ?s,website = ?s,origin = ?s,yearsActive = ?s WHERE  Id = ?s',
            $_POST['nameBand'], $_POST['genreMusic'], $_POST['email'],$_POST['aboutBand'], $_POST['skype'],$_POST['twitter'],$_POST['instagram'], $_POST['facebook'],
            $_POST['website'],$_POST['origin'],$_POST['yearsActive'], $_COOKIE['Id']);
    }
    public function editBand($nameBand,$genreMusic){
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $modelUser = $this->getBand($fullPath[5]);
        $modelUser->bandName = $nameBand;
        $modelUser->genreMusic = $genreMusic;
        $this->updateUser($modelUser);
    }
    public function updateUser($modelUser){
        $this->databaseInterface->query('UPDATE users SET email=?s ,genreMusic=?s, bandName=?s WHERE userName=?s',$modelUser->email, $modelUser->genreMusic, $modelUser->bandName, $modelUser->userName);
    }
    public function getNameUser()
    {
        return $this->getUser()->userName;
    }
    public function saveUser(){
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
                quotemeta($_POST['firstName']), quotemeta($_POST['lastName']),
                quotemeta($_POST['userName']),  quotemeta($_POST['email']),
                $activation, quotemeta($_POST['typeAccount']));
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