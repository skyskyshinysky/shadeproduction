<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Sound Side</title>
    <script src="/js/jquery-3.2.1.min.js" type="text/javascript"></script>
    <script src="/js/sha256.js" type="text/javascript"></script>

    <script src="/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="/js/audioplayer.js" type="text/javascript"></script>
    <link rel="stylesheet" href="/css/tabs.css" />
    <script src="/js/amplitude.js" type="text/javascript"></script>
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
            <div id="listMenu" style="display: none;">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <?php 
                                    if($data['authorize']) {
                                        $uri = 'http://' . $_SERVER['HTTP_HOST'] . '/main';
                                    } else {
                                        $uri = 'http://' . $_SERVER['HTTP_HOST'] . '/main/welcome';
                                    }
                                    echo '<a class="list-link" href="'. $uri .'">Sound Side</a>';
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if($data['authorize']) {
                                    echo '<a class="list-link" href="http://' . $_SERVER['HTTP_HOST'] . '/main">Music</a>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if($data['authorize']) {
                                    echo '<a class="list-link" href="http://' . $_SERVER['HTTP_HOST'] . '/main/people">People</a>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if($data['authorize']) {
                                        if(strcasecmp($data['typeAccount'], 'band') == 0) {
                                            $link = "/user/profileBand/" . $data['userName'];
                                        } else {
                                            $link = "/user/profile/" . $data['userName'];
                                        }
                                        echo '<a class="list-link" href="/user/logout">Log out</a>';
                                    } else {
                                    echo '<a class="list-link href="/login">Log In</a>';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
                                    if($data['authorize']) {
                                        if(strcasecmp($data['typeAccount'], 'band') == 0) {
                                            $link = "/user/profileBand/" . $data['userName'];
                                        } else {
                                            $link = "/user/profile/" . $data['userName'];
                                        }
                                        echo '<a class="list-link" id="myProfile" href=' .$link .'>My profile</a>';
                                    } else {
                                    echo '<a class="list-link" href="/login/signIn">Register</a>';
                                    }
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
                <?php if($data['authorize']) {
                    echo '<a class="navigation-bar-link" href="http://' . $_SERVER['HTTP_HOST'] . '/main">Music</a>
                    <a class="navigation-bar-link" href="http://' . $_SERVER['HTTP_HOST'] . '/main/people">People</a>';
                }
                ?>
            </div>
            <div class="navigation-bar-authentication">
                <?php if($data['authorize']) {

                    if(strcasecmp($data['typeAccount'], 'band') == 0) {
                        $link = "/user/profileBand/" . $data['userName'];
                    } else {
                        $link = "/user/profile/" . $data['userName'];
                    }
                    echo '<a class="navigation-bar-authentication-link" href="/user/logout">Log out</a>
                          <a class="navigation-bar-authentication-link" id="myProfile" href=' .$link .'>My profile</a>';
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

<script type="text/javascript">
    var navigationBarCollapse = function () {
        if ( $(window).width() < 700) {
            $(function(){
                $('div.navigation-bar-header').hide();
                $('div.navigation-bar-menu').hide();
                $('div.navigation-bar-authentication').hide();
                $('#listMenu').show();
            });
        }
        else {
            $(function(){
                $('div.navigation-bar-header').show();
                $('div.navigation-bar-menu').show();
                $('div.navigation-bar-authentication').show();
                $('#listMenu').hide();
            });
        }
        if ( $(window).width() < 920) {
            $(function(){
                $('div.song-info').hide();
                $('div.slider').hide();
            });
        }
        else {
            $(function(){
                $('div.song-info').show();
                $('div.slider').show();
            });
        }
        if ( $(window).width() < 660) {
            $(function(){
                $('#listPlayerWrapper').show();
                $('div.player-wrapper').hide();
            });
        }
        else {
            $(function(){
                $('#listPlayerWrapper').hide();
                $('div.player-wrapper').show();
            });
        }
    }

    $(window).resize(navigationBarCollapse); 
</script>>