<script>
    $( function()
    {
        $( 'audio' ).audioPlayer();
    });
</script>

<?php extract($data); ?>

<form action= <?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/user/uploadMusicBand/' . $userName;?>  method="post" enctype="multipart/form-data" >
    <input name="token" type="hidden" value="<?php echo $_COOKIE['Hash'] ?>" />
    <div style="width: 100%; margin-top: 30px; position: relative;">
        <label class="button"> 
            Select file...
            <input type="file" name="uploadFile" style="display: none;" />
        </label>
    </div>
    <div style="width: 100%; margin-top: 30px; position: relative;">
         <select id="genreMusic" class="button" name="genreMusic">
            <option>Rock</option>
            <option>Classic</option>
            <option>Rap</option>
            <option>Pop</option>
            <option>Punk</option>
        </select>
    </div>
    <div style="width: 100%; margin-top: 30px; position: relative;">
        <input class="button" type="submit" name="submit" value="Upload"/>
    </div>
</form>
