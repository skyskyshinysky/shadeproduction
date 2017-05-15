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
    public $about;

    public $phone;
    public $skype;
    public $twitter;
    public $instagram;
    public $facebook;
    public $website;

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
            'email' => $this->email,
            'genreMusic' => $this->genreMusic,
            'about' => $this->about
        );
    }
    function getDataBand()
    {
        return array(
            'Id' => $this->id,
            'userName' => $this->userName,
            'email' => $this->email,
            'bandName' => $this->bandName,
            'genreMusic' => $this->genreMusic,
            'about' => $this->about,
            'phone' => $this->phone,
            'skype' => $this->skype,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'website' => $this->website
        );
    }

}