<?php

class ModelSong{
    public $id;
    public $nameMusic;
    public $pathFile;
    public $bandId;

    function getDataSongs()
    {
        return array(
            'Id' => htmlspecialchars($this->id),
            'nameMusic' => htmlspecialchars($this->nameMusic),
            'pathFile' => htmlspecialchars($this->lastName),
            'bandId' => htmlspecialchars($this->userName)
        );
    }
}