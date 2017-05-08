<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 07.05.2017
 * Time: 19:29
 */
class ModelComment extends Model
{
    public $id;
    public $userName;
    public $idBand;
    public $time;
    public $message;

    function getDataComment()
    {
        return array(
            'Id' => $this->id,
            'userName' => $this->userName,
            'email' => $this->email
        );
    }
}