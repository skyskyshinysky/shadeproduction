<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Sound Side</title>

    <script src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/js/audioplayer.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/css/site.css">
    <link rel="stylesheet" type="text/css" href="/css/audioPlayer.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
	<link rel="manifest" href="/favicons/manifest.json">
	<link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="theme-color" content="#ffffff">
</head>
<body>
    <div class="navigation-bar">
        <div class="navigation-bar-wrapper">
            <div class="navigation-bar-header">
                <?php if($data['authorize']) {
                    $uri = 'http://' . $_SERVER['HTTP_HOST'] . '/main';
                } else {
                    $uri = 'http://' . $_SERVER['HTTP_HOST'] . '/main/welcome';
                }
                echo '<a class="navigation-bar-header-link" href="'. $uri .'">Sound Side</a>';
                ?>
            </div>
            <div class="navigation-bar-menu">
                <a class="navigation-bar-link" href="">Music</a>
                <a class="navigation-bar-link" href="">People</a>
            </div>
            <div class="navigation-bar-authentication">
                <?php if($data['authorize']) {

                    if(strcasecmp($data['typeAccount'], 'band') == 0) {
                        $link = "/user/profileBand/" . $data['userName'];
                    } else {
                        $link = "/user/profile/" . $data['userName'];
                    }
                    echo '<a class="navigation-bar-authentication-link" href="/user/logout">Log out</a>
                          <a class="navigation-bar-authentication-link" href=' .$link .'>My profile</a>';
                } else {
                    echo '<a class="navigation-bar-authentication-link" href="/login">Log In</a>
                          <a class="navigation-bar-authentication-link" href="/login/signIn">Register</a>';
                }
                ?>

            </div>
        </div>
    </div>
    <div class="content">
    	<?php  include ROOT . '/application/views/'.$contentView; ?>
        <hr />
        <footer>
            <p>&copy; Shade Production - Sound Side</p>
        </footer>
    </div>
</body>
</html>
