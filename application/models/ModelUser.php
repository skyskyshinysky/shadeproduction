<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 04.05.2017
 * Time: 20:51
 */
class ModelUser extends Model
{
    public $id;
    public $firstName;
    public $lastName;
    public $userName;
    public $email;
    public $bandName;
    public $genreMusic;

    function __construct($username)
    {
        $this->userName = $username;
    }
    function getDataUser()
    {
        return array(
            'Id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'userName' => $this->userName,
            'email' => $this->email
        );
    }
    function getDataBand()
    {
        return array(
            'Id' => $this->id,
            'userName' => $this->userName,
            'email' => $this->email,
            'bandName' => $this->bandName
        );
    }

}