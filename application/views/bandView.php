<script>
    var rowsPerPage = 10;
    function getPage(page_num)
    {
        $('#wallBand').html('');
        $.get('/user/getPageNum/?pageNum='+page_num, function(data){
            //парсим JSON
            var items = JSON.parse(data);
            // строим и выводим каркас для 10 записей
            for(var count = 0; count < items.length; count++) {
                $('#wallBand').append('<div class="comment"><div class="headingPanel"><div class="inlineUserBlock">' +
                    items[count].userName + '</div><span class="date">' + items[count].time + '</span></div><ui class="list-group"><li>' +
                    items[count].message + '</li></ui></div>');
            }
        });
    }
    function initPageNumbers()
    {
        $.get('/user/getCountComments',function (data) {
            totalRows = parseInt(data);
            if(totalRows > 10) {
                var count = 1;
                for (var x = 0; x < totalRows; x += rowsPerPage) {
                    $('#page-numbers').append('<li><a href="#' + count + '" onclick="getPage(' + count + ');">' + count + '</a></li>');
                    count++;
                }
            }
        });
    }
    function sendMessageInBand() {
        var data = $('#messageBody').val();
        console.log('data = ' + data);
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: "/user/sendMessage",
            data: "message=" + JSON.stringify($('#messageBody').val()),
            success: function(result) {
                $('#messageBody').val('');
            },
            error: function(result) {
                // todo: handle error;
            },
            processData: false,
            async: false
        });
    }
    function initializeComments()
    {
        //получаем в переменную data комменты
        $.get('/user/getComments',function (data) {
            //парсим JSON
            var items = JSON.parse(data);
            // строим и выводим каркас для 10 записей
            for(var count = 0; count < items.length; count++) {
                $('#wallBand').append('<div class="comment"><div class="headingPanel"><div class="inlineUserBlock">' +
                    items[count].userName + '</div><span class="date">' + items[count].time + '</span></div><ui class="list-group"><li>' +
                    items[count].message + '</li></ui></div>');
            }
        });
    }
    function sendMessageRenameBand()
    {
        var data = $('#renameBand').val();
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: "/user/sendMessageRenameBand",
            data: 'message=' + JSON.stringify($('#renameBand').val()) + '&jenre=' + JSON.stringify($('#genreMusic').val()),
            success: function(result) {
                $('#nameBand').text(data);
            },
            error: function(result) {
                // todo: handle error;
            },
            processData: false,
            async: false
        });
    }
    function callbackFocusout()
    {
        if($(this).val()=='') $(this).val('Name band...');
        $("#box").fadeOut(100);
        visib = false;
    }
    function callbackFocusin()
    {
        if($(this).val()=='Name band...') $(this).val('');
    }
    $(document).ready(function() {
        $("#renameBand").on('focusout', callbackFocusout);
        $("#renameBand").on('focusin', callbackFocusin);
        $('#sendMessageRenameBand').on('click', sendMessageRenameBand);
        $('#sendMessageInBand').on('click', sendMessageInBand);
        initializeComments();
        $( 'audio' ).audioPlayer();
        initPageNumbers();
    });

</script>

<?php
    extract($data);
    echo '<h1>Это типа страница банды <p id="nameBand">' . $bandName . '</p></h1>';
?>
<p>Логотипчик рядом с ней Юзернейм</p>

<?php

    echo '<br>' . $userName . '<br>';
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
    echo '</form><br>';
    echo  $email . '<br>';
    if($owner) {
        echo '<input type="text" size="30" maxlength="70" autocomplete="off" id="renameBand" value="Name band..."/>
        <select id="genreMusic" name="genreMusic">
                <option>Rock</option>
                <option>Classic</option>
                <option>Rap</option>
                <option>Pop</option>
                <option>Punk</option>
        </select><button id="sendMessageRenameBand">Rename Band</button>';
        echo '<a href=/user/uploadMusicBand/'. $userName . '>Upload Music</a><br>';
    }
?>
<textarea id="messageBody" placeholder="Message Body"></textarea>
<button id="sendMessageInBand">Send Message</button>

    <a href="/user/logout"> Log out</a>
    <a href="/user/playlist"> Playlist</a>
    <a href="/user/photo"> Photo</a>
    <a href="/user/logout"> </a>
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
<br>
<div id="wallBand">
</div>
<ul id="page-numbers"></ul>