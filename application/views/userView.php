<?php
    extract($data);
?>
<h1>Это типа страница пользователя</h1>
<p>Фоточка типа я рядом с ней Имя Юзернейм Фамилия</p>
<?php
    echo '<br>' . $firstName . ' ' . $userName . ' ' . $lastName;
    echo '<br>' . $email . '<br>';
?>
<a href="/user/logout"> Log out</a>
<a href="/user/music"> Music</a>
<a href="/user/playlist"> Playlist</a>
<a href="/user/photo"> Photo</a>
<a href="/user/logout"> </a>
