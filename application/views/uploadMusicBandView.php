<script>
    $( function()
    {
        $( 'audio' ).audioPlayer();
    });
</script>

<?php extract($data); ?>

<form action="http://www.shadeproduction.local/user/uploadMusicBand/shadeproduction" method="post" enctype="multipart/form-data" >
    <div style="width: 100%; margin-top: 30px; position: relative;">
        <label class="button"> 
            Select file
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
