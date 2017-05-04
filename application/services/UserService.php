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

    function __construct($interface)
    {
        $this->databaseInterface = $interface;
    }
    public function getUser($userName)
    {
        $modelUser = new ModelUser($userName);
        $result = $this->databaseInterface->getRow('SELECT * FROM users WHERE userName = ?s', $modelUser->userName);
        $modelUser->id = $result['Id'];
        $modelUser->firstName = $result['firstName'];
        $modelUser->lastName = $result['lastName'];
        $modelUser->email = $result['email'];
        return $modelUser;
    }
}