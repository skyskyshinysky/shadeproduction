<h1>Это типа страница банды</h1>
<p>Логотипчик рядом с ней Юзернейм</p>
<?php
    extract($data);
    echo '<img src="http://' . $_SERVER['HTTP_HOST']  . $logoBand['pathFile'] . $logoBand['nameLogo'] . '" alt="Logo">';
    echo '<form action="http://' . $_SERVER['HTTP_HOST'] . '/user/profileBand/' . $userName . '" method="post" enctype="multipart/form-data" >'
?>
<table>
    <tr>
        <td><input type="file" name="uploadFileLogo" /></td>
    </tr>
    <tr>
        <td><input type="submit" name="submit" value="Upload"/></td>
    </tr>
</table>
<?php
    echo '</form>';
    echo '<br>' . $userName;
    echo '<br>' . $email . '<br>';
    echo '<a href=/user/musicBand/'. $userName . '> Music</a>';
?>

    <a href="/user/logout"> Log out</a>
    <a href="/user/playlist"> Playlist</a>
    <a href="/user/photo"> Photo</a>
    <a href="/user/logout"> </a>
<?php