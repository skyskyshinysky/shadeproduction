<script>
    $( function()
    {
        $( 'audio' ).audioPlayer();
    });
</script>
<?php
    extract($data);
    echo '<a href=/user/profileBand/'. $userName . '>Profile</a>';
?>
<form action="http://www.shadeproduction.local/user/uploadMusicBand/shadeproduction" method="post" enctype="multipart/form-data" >
<table>
    <tr>
        <td><input type="file" name="uploadFile" /></td>
    </tr>
    <tr>
        <td>
            <select id="genreMusic" name="genreMusic">
                <option>Rock</option>
                <option>Classic</option>
                <option>Rap</option>
                <option>Pop</option>
                <option>Punk</option>
            </select>
        </td>
    </tr>
    <tr>
        <td><input type="submit" name="submit" value="Upload"/></td>
    </tr>
</table>
</form>

<div id="wrapper">
<?php
    foreach ($data['musicBand'] as $musicBand) {
        echo '<br>' . $musicBand['nameMusic'];
        echo '<audio preload="auto" controls>';
        echo '<source src="http://'. $_SERVER['HTTP_HOST'] . '/' . $musicBand['pathFile'] . $musicBand['nameMusic'] . '" type="audio/mp3"/>';
        echo '</audio>';
    }
?>
</div>
