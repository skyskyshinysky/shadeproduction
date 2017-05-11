<script type="text/javascript">
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
?>

<div class="profile">
    <div style="display: inline-block;">
        <div class="main-profile-info">
            <div class="logo-wrapper">
                <?php
                    echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . $logoBand['pathFile'] . $logoBand['nameLogo'] . '" />';
                ?>
            </div>
            <div>
                <?php
                    echo '<h2 style="text-align: center;" id="nameBand">' . $bandName . '</h2>';
                ?>
            </div>
            <div>
                <?php
                    echo '<h3 style="text-align: center;" id="nameBand">Genre is here ' .$genreMusic . '</h3>';
                ?>
            </div>
        </div>
        <div class="profile-info">
            <div>
                <p style="margin: 0;">
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. 
                </p>
            </div>
            <div>
                <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. 
                </p>
            </div>
        </div>        
    </div>

    <?php
        echo  $email . '<br>';
        if($owner) {
            echo '<a href=/user/uploadMusicBand/'. $userName . '>Upload Music</a><br>
            <a href=/user/profileBandEdit/'. $userName . '>Edit profile</a><br>';
        }
    ?>
    <textarea id="messageBody" placeholder="Message Body"></textarea>
    <button id="sendMessageInBand">Send Message</button>
        <a href="/user/playlist">Playlist</a>
        <a href="/user/photo"> Photo</a>
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
</div>
