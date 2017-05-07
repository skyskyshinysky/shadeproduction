<?php

/**
 * Created by PhpStorm.
 * User: Ilya Pankov
 * Date: 04.05.2017
 * Time: 13:25
 */
class ControllerUser extends Controller
{
    function actionProfile() {
        $data = null;
        require_once(ROOT . '/application/services/UserService.php');
        $userService = new UserService($this->databaseInterface);
        if(isset($_GET['userNameDefaultPage']) and $this->authorizeController->statusCookies == true)
        {
            if(($this->model = $userService->getUser($_GET['userNameDefaultPage'])) != null)
            {
                $data = $this->model->getDataUser();
                $this->view->generate('userView.php', 'templateView.php', $data);
                return;
            }
        }
        $this->view->generate('404View.php', 'templateView.php', $data);
    }
    function actionProfileBand() {
        $data = null;
        require_once(ROOT . '/application/services/UserService.php');
        require_once(ROOT . '/application/services/ImageService.php');
        $userService = new UserService($this->databaseInterface);
        $imageService = new ImageService($this->databaseInterface);
        if(($this->model = $userService->getBand($_GET['userNameDefaultPage'])) != null
            and $this->authorizeController->statusCookies == true)
        {
            $data = $this->model->getDataBand();
            if(isset($_POST['submit'])) {
                $imageService->uploadLogo();
            }
            $data['logoBand'] = $imageService->getLogoBand();
            $this->view->generate('bandView.php', 'templateView.php', $data);
            return;
        }
        $this->view->generate('404View.php', 'templateView.php', $data);
    }
    function actionMusicBand()
    {

        $data = null;
        require_once(ROOT . '/application/services/UserService.php');
        require_once (ROOT . '/application/services/MusicService.php');
        $musicService = new MusicService($this->databaseInterface);
        $userService = new UserService($this->databaseInterface);
        if(($this->model = $userService->getBand($_GET['userNameMusicBand'])) != null
            and $this->authorizeController->statusCookies == true) {
            if(isset($_POST['submit'])) {
                $musicService->uploadMusic();
            }
            $data = $this->model->getDataBand();
            $data['musicBand'] = $musicService->getMusicBand();
            $this->view->generate('musicBandView.php', 'templateView.php', $data);
            return;
        }
        $this->view->generate('404View.php', 'templateView.php', $data);
    }
    function actionLogout()
    {
        $this->authorizeController->destroyCookie();
        header('Location: http://' . $_SERVER['HTTP_HOST']);
    }
    function actionIndex()
    {
        echo 'actionIndex';
    }
}