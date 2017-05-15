<?php
class ControllerUser extends Controller
{
    function actionProfile() {
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
                $data['authorize'] = true;
                $data['typeAccount'] = $this->authorizeController->typeAccount;
                $data['owner'] = false;
                $data['logoBand'] = $imageService->getLogoBand();
                if(strcasecmp($_COOKIE['Id'], $this->model->id) == 0) {
                    $data['owner'] = true;
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
    function actionSendMessageRenameBand()
    {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        $jenreMusic = json_decode($_POST['jenre']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editBand($message, $jenreMusic);
        }
    }
    function actionSendMesssageEditSkype() {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editSkypeBand($message);
        }
    }
    function actionSendMesssageEditTwitter() {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editTwitterBand($message);
        }
    }
    function actionSendMesssageEditInstagram() {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editInstagramBand($message);
        }
    }
    function actionSendMesssageEditFacebook() {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editFacebookBand($message);
        }
    }
    function actionSendMesssageEditWebsite() {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editWebsiteBand($message);
        }
    }
    function actionSendMesssageEditPhone() {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editPhoneBand($message);
        }
    }
    function actionSendMessageAboutBand() {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
            $userService->editAboutBand($message);
        }
    }
    function actionSendMessageEditMail()
    {
        require_once(ROOT . '/application/services/UserService.php');
        $message = json_decode($_POST['message']);
        if( $this->authorizeController->statusCookies == true and isset($message)
            and !empty($message)) {
            $userService = new UserService($this->databaseInterface);
        }
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
    function actionProfileBandEdit() {

        require_once(ROOT . '/application/services/ImageService.php');
        $imageService = new ImageService($this->databaseInterface);
        $data = $this->actionProfileBand(true);
        if( $data['owner'] = true) {
            if(isset($_POST['submit'])) {
                $imageService->uploadLogo();
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
            if(isset($_POST['submit'])) {
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