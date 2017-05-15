<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 07.05.2017
 * Time: 19:41
 */
class CommentService
{
    private $databaseInterface;

    function __construct($interface)
    {
        $this->databaseInterface = $interface;
    }

    public function saveComment($modelComment)
    {
        $this->databaseInterface->query('INSERT INTO comment (userName,idBand,time,message) VALUES(?s,?s,?s,?s)',
            $modelComment->userName, $modelComment->idBand, $modelComment->time, $modelComment->message);
    }
    public function getComments($numberRow = null)
    {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        if($numberRow != null && $numberRow != 1) {
            return $this->databaseInterface->getAll('SELECT userName, time, message FROM comment WHERE idBand=?s ORDER BY time LIMIT 10 OFFSET ?i',
                ($this->databaseInterface->getOne('SELECT Id FROM users WHERE userName=?s', $fullPath[5])),10 * ($numberRow-1));
        }
        $idBand = $this->databaseInterface->getOne('SELECT Id FROM users WHERE userName=?s', $fullPath[5]);
        return $this->databaseInterface->getAll('SELECT userName, time, message FROM comment WHERE idBand=?s ORDER BY time LIMIT 10',$idBand);
    }
    public function addComment()
    {
        require_once (ROOT . '/application/models/ModelComment.php');
        $message = $_POST['message'];
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        if(!empty($fullPath[5]) and isset($message) and !empty($message)) {
           $modelComment = new ModelComment();
           $modelComment->idBand = $this->databaseInterface->getOne('SELECT Id FROM users WHERE userName=?s', $fullPath[5]);
           $modelComment->message = $message;
           $modelComment->time = date("Y-m-d H:i:s");
           $modelComment->userName = $this->databaseInterface->getOne('SELECT userName FROM users WHERE Id=?s', $_COOKIE['Id']);
           $this->saveComment($modelComment);
        }
    }
    public function countCommentService()
    {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        if(!empty($fullPath[5])) {
            return $this->databaseInterface->getOne('SELECT COUNT(*) FROM comment WHERE idBand=?s',
                ($this->databaseInterface->getOne('SELECT Id FROM users WHERE userName=?s', $fullPath[5])));
        }
    }
}