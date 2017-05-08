<?php

class MusicService
{
    private $databaseInterface;

    function __construct($interface)
    {
        $this->databaseInterface = $interface;
    }

    private function saveMusic($uploadDir)
    {
        $this->databaseInterface->query('INSERT INTO music (Id,nameMusic,pathFile,bandId,genreMusic) VALUES(?s,?s,?s,?s,?s)',  $this->databaseInterface->guidv4(),
            $_FILES['uploadFile']['name'], $uploadDir, $_COOKIE['Id'], $_POST['genreMusic']);
    }
    function uploadMusic()
    {
        // Каталог, в который мы будем принимать файл:
        $uploadDir = ROOT . '\data\music\\' ;
        $uploadFile = $uploadDir.basename($_FILES['uploadFile']['name']);
        // Копируем файл из каталога для временного хранения файлов:
        if (copy($_FILES['uploadFile']['tmp_name'], $uploadFile))
        {
            echo "<h3>Файл успешно загружен на сервер</h3>";
        }
        else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }

        // Выводим информацию о загруженном файле:
        echo "<h3>Информация о загруженном на сервер файле: </h3>";
        echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadFile']['name']."</b></p>";
        echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadFile']['type']."</b></p>";
        echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadFile']['size']."</b></p>";
        echo "<p><b>Временное имя файла: ".$_FILES['uploadFile']['tmp_name']."</b></p>";
        $this->saveMusic('\data\music\\');
    }
    function getMusicBand(){
        $fullPath = explode('/', $_SERVER['REQUEST_URI']);

        return $this->databaseInterface->getAll('SELECT nameMusic, pathFile FROM music WHERE bandId = ?s',
            $this->databaseInterface->getOne('SELECT Id FROM users WHERE userName=?s', $fullPath[3]));
    }
}