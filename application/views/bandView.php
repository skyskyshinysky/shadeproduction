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
    $(document).ready(function() {
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
?>
<?php

    echo  $email . '<br>';
    if($owner) {
        echo '<a href=/user/uploadMusicBand/'. $userName . '>Upload Music</a><br>
        <a href=/user/profileBandEdit/'. $userName . '>Edit profile</a><br>';
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