<?php
class ControllerUser extends Controller
{
    function actionProfile($status = null) {
        $data['authorize'] = false;
        require_once(ROOT . '/application/services/UserService.php');
        require_once(ROOT . '/application/services/ImageService.php');
        $userService = new UserService($this->databaseInterface);
        $imageService = new ImageService($this->databaseInterface);
        if(isset($_GET['userNameDefaultPage']) and $this->authorizeController->statusCookies == true)
        {
            if(($this->model = $userService->getUser($_GET['userNameDefaultPage'])) != null)
            {
                $data = $this->model->getDataUser();
                $data['userName'] = $this->authorizeController->username;
                $data['authorize'] = true;
                $data['typeAccount'] = $this->authorizeController->typeAccount;
                $data['owner'] = false;
                $data['logoBand'] = $imageService->getLogoBand();
                if(strcasecmp($_COOKIE['Id'], $this->model->id) == 0) {
                    $data['owner'] = true;
                }
                if($status == true) {
                    return $data;
                }
                $this->view->generate('userView.php', 'templateView.php', $data);
                return;
            }
        }
        $this->view->generate('404View.php', 'templateView.php', $data);
    }
    function actionSendMessage(){

        require_once(ROOT . '/application/services/CommentService.php');
        if( $this->authorizeController->statusCookies == true and isset($_POST['message'])
            and !empty($_POST['message'])) {
            $commentService = new CommentService($this->databaseInterface);
            $commentService->addComment();
        }
    }
    function actionGetBlockDataPeople() {
        $data = null;
        require_once(ROOT . '/application/services/UserService.php');
        if( $this->authorizeController->statusCookies == true) {
            $userService = new UserService($this->databaseInterface);
            $data = $userService->getPeople();
        }
        echo json_encode($data);
    }
    function actionGetBlockData()
    {
        $data = null;
        $type = json_decode($_POST['type']);
        $genreMusic = json_decode($_POST['jenre']);
        require_once(ROOT . '/application/services/UserService.php');
        if( $this->authorizeController->statusCookies == true and isset($type)
            and !empty($type) and isset($genreMusic) and !empty($genreMusic)) {
            $userService = new UserService($this->databaseInterface);
            switch ($type) {
                case 'Songs':
                    $data = $userService->getSongs($genreMusic);
                    break;
                case 'Artists':
                    $data = $userService->getBands($genreMusic);
                    break;
            }
        }
        echo json_encode($data);
    }
    function actionGetCountComments()
    {
        require_once(ROOT . '/application/services/CommentService.php');
        $commentService = new CommentService($this->databaseInterface);
        echo htmlspecialchars($commentService->countCommentService());
    }
    function actionGetComments()
    {
        require_once(ROOT . '/application/services/CommentService.php');
        $commentService = new CommentService($this->databaseInterface);
        echo json_encode($commentService->getComments());
    }

    function actionGetPageNum()
    {
        require_once(ROOT . '/application/services/CommentService.php');
        $commentService = new CommentService($this->databaseInterface);
        echo json_encode($commentService->getComments($_GET['pageNum']));
    }
    function actionProfileEdit()
    {
        require_once(ROOT . '/application/services/ImageService.php');
        $imageService = new ImageService($this->databaseInterface);
        $data = $this->actionProfile(true);
        if( $data['owner'] = true)
        {
            if(isset($_POST['save']) and $_COOKIE['Hash'] == $_POST['token']) {
                if(isset($_FILES['uploadFileLogo']['name']) and !empty($_FILES['uploadFileLogo']['name'])) {
                    $imageService->uploadLogo();
                }
                $userService = new UserService($this->databaseInterface);
                $userService->updateInformationUser();
                $data = $this->actionProfile(true);
            }
            $this->view->generate('userEditView.php', 'templateView.php', $data);
        } else {
            $this->view->generate('404View.php', 'templateView.php', $data);
        }
    }
    function actionProfileBandEdit() {

        require_once(ROOT . '/application/services/ImageService.php');
        $imageService = new ImageService($this->databaseInterface);
        $data = $this->actionProfileBand(true);

        if( $data['owner'] = true) {
            if(isset($_POST['save']) and $_COOKIE['Hash'] == $_POST['token']) {
                if(isset($_FILES['uploadFileLogo']['name']) and !empty($_FILES['uploadFileLogo']['name'])) {
                    $imageService->uploadLogo();
                }
                $userService = new UserService($this->databaseInterface);
                $userService->updateInformationBand();
                $data = $this->actionProfileBand(true);
            }
            $this->view->generate('bandEditView.php', 'templateView.php', $data);
        } else {
            $this->view->generate('404View.php', 'templateView.php', $data);
        }

    }

    function actionProfileBand($status = null) {
        $data = null;
        $data['authorize'] = false;
        require_once(ROOT . '/application/services/UserService.php');
        require_once(ROOT . '/application/services/ImageService.php');
        require_once (ROOT . '/application/services/MusicService.php');

        $userService = new UserService($this->databaseInterface);
        $imageService = new ImageService($this->databaseInterface);
        $musicService = new MusicService($this->databaseInterface);

        if(isset($_GET['userNameDefaultPage']) and ($this->model = $userService->getBand($_GET['userNameDefaultPage'])) != null
            and $this->authorizeController->statusCookies == true)
        {
            $data = $this->model->getDataBand();
            $data['authorize'] = true;
            $data['userName'] = $this->authorizeController->username;
            $data['logoBand'] = $imageService->getLogoBand();
            $data['musicBand'] = $musicService->getMusicBand();
            $data['owner'] = false;
            $data['typeAccount'] = $this->authorizeController->typeAccount;
            if(strcasecmp($_COOKIE['Id'], $this->model->id) == 0) {
                $data['owner'] = true;
            }
            if($status == true) {
                return $data;
            }
            $this->view->generate('bandView.php', 'templateView.php', $data);
            return;
        }

        $this->view->generate('404View.php', 'templateView.php', $data);
    }
    function actionGetSongsBand() {
        $fullPath = explode('/', $_SERVER['HTTP_REFERER']);
        $result =  $this->databaseInterface->getAll('SELECT music.nameMusic, music.pathFile, users.bandName FROM music, users WHERE users.userName = ?s  LIMIT 15',
            $fullPath[5]);
        $data = [];
        for ($count = 0; $count < count($result); $count++) {
            $data[$count] = array(
                "name" => $result[$count]['nameMusic'],
                "artist" => $result[$count]['bandName'],
                "url" => $result[$count]['pathFile'] . $result[$count]['nameMusic']);
        }
        echo json_encode($data);
    }
    function actionUploadMusicBand()
    {
        $data = null;
        $data['authorize'] = false;
        require_once(ROOT . '/application/services/UserService.php');
        require_once (ROOT . '/application/services/MusicService.php');
        $musicService = new MusicService($this->databaseInterface);
        $userService = new UserService($this->databaseInterface);
        if(($this->model = $userService->getBand($_GET['userNameMusicBand'])) != null
            and $this->authorizeController->statusCookies == true) {
            if(isset($_POST['submit']) and isset($_POST['token']) and
                $_COOKIE['Hash'] == $_POST['token']) {
                $musicService->uploadMusic();
            }
            $data = $this->model->getDataBand();
            $data['authorize'] = true;
            $data['musicBand'] = $musicService->getMusicBand();
            $data['typeAccount'] = $this->authorizeController->typeAccount;
            $this->view->generate('uploadMusicBandView.php', 'templateView.php', $data);
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