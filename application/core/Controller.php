<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 02.05.2017
 * Time: 16:07
 */
class Controller
{
    public $view;
    public $model;

    function __construct()
    {
        $this->view = new View();
    }

}