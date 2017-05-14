<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 07.05.2017
 * Time: 17:22
 */
class ImageService
{
    private $databaseInterface;

    function __construct($interface)
    {
        $this->databaseInterface = $interface;
    }
    private function saveLogo($uploadDir)
    {
        $this->databaseInterface->query('INSERT INTO logo (Id,nameLogo,pathFile) VALUES(?s,?s,?s) ON DUPLICATE KEY UPDATE nameLogo=?s',
            $_COOKIE['Id'], $_FILES['uploadFileLogo']['name'], $uploadDir, $_FILES['uploadFileLogo']['name']);
    }
    function getLogoBand()
    {
        $fullPath = explode('/', $_SERVER['REQUEST_URI']);
        return $this->databaseInterface->getRow('SELECT nameLogo, pathFile FROM logo WHERE Id = ?s',
            $this->databaseInterface->getOne('SELECT Id FROM users WHERE userName=?s', $fullPath[3]));
    }
    function uploadLogo()
    {
        // Каталог, в который мы будем принимать файл:
        $uploadDir = ROOT . '\images\logo\\' ;
        $uploadFile = $uploadDir.basename($_FILES['uploadFileLogo']['name']);

        // Копируем файл из каталога для временного хранения файлов:
        if (copy($_FILES['uploadFileLogo']['tmp_name'], $uploadFile))
        {
            echo "<h3>Файл успешно загружен на сервер</h3>";
        }
        else { echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>"; exit; }

        // Выводим информацию о загруженном файле:
        echo "<h3>Информация о загруженном на сервер файле: </h3>";
        echo "<p><b>Оригинальное имя загруженного файла: ".$_FILES['uploadFileLogo']['name']."</b></p>";
        echo "<p><b>Mime-тип загруженного файла: ".$_FILES['uploadFileLogo']['type']."</b></p>";
        echo "<p><b>Размер загруженного файла в байтах: ".$_FILES['uploadFileLogo']['size']."</b></p>";
        echo "<p><b>Временное имя файла: ".$_FILES['uploadFileLogo']['tmp_name']."</b></p>";
        $this->saveLogo('\data\images\logo\\');
    }
    public function save404Logo($guid) {
        $this->databaseInterface->query('INSERT INTO logo (Id,nameLogo,pathFile) VALUES(?s,"404avatar.jpg","/images/logo/")',
            $guid);
    }
}