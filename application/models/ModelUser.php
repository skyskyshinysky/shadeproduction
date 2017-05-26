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

    public $origin;
    public $yearsActive;
    public $skype;
    public $twitter;
    public $instagram;
    public $facebook;
    public $website;
    public $male;
    public $city;
    public $language;

    function __construct($username)
    {
        $this->userName = $username;
    }
    function getDataUser()
    {
        return array(
            'Id' => htmlspecialchars($this->id),
            'firstName' => htmlspecialchars($this->firstName),
            'lastName' => htmlspecialchars($this->lastName),
            'userName' => htmlspecialchars($this->userName),
            'email' => htmlspecialchars($this->email),
            'genreMusic' => htmlspecialchars($this->genreMusic),
            'about' => htmlspecialchars($this->about),
            'skype' => htmlspecialchars($this->skype),
            'origin' => htmlspecialchars($this->origin),
            'yearsActive' => htmlspecialchars($this->yearsActive),
            'twitter' => htmlspecialchars($this->twitter),
            'instagram' => htmlspecialchars($this->instagram),
            'facebook' => htmlspecialchars($this->facebook),
            'website' => htmlspecialchars($this->website),
            'male' => htmlspecialchars($this->male),
            'city' => htmlspecialchars($this->city),
            'language' => htmlspecialchars($this->language)
        );
    }
    function getDataBand()
    {
        return array(
            'Id' => htmlspecialchars($this->id),
            'userName' => htmlspecialchars($this->userName),
            'email' => htmlspecialchars($this->email),
            'bandName' => htmlspecialchars($this->bandName),
            'genreMusic' => $this->genreMusic,
            'about' => htmlspecialchars($this->about),
            'skype' => htmlspecialchars($this->skype),
            'origin' => htmlspecialchars($this->origin),
            'yearsActive' => htmlspecialchars($this->yearsActive),
            'twitter' => htmlspecialchars($this->twitter),
            'instagram' => htmlspecialchars($this->instagram),
            'facebook' => htmlspecialchars($this->facebook),
            'website' => htmlspecialchars($this->website)
        );
    }

}