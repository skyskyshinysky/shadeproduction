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
    <div style="display: inline-block; position: relative;">
        <?php
            if($owner) {
                echo '<div style="position: absolute; top: 0px; right: 20px; width: 24px; height: 24px; padding: 0; margin: 0;"><a href=/user/profileBandEdit/'. $userName . '><img src="/images/x24/gear.png" alt="Edit profile"></a></div>';
            }
        ?>
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
            <div class="contact-info">
                <h3 style="margin: 0;">Contact info</h3>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/global.png" alt="Website" /></span>
                    <?php echo ' <span class="contact-info-text""><b>Website:</b> <a href="mailto:'. $email . '">'. $email . '</a></span>' ?>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/facebook.png" alt="Facebook" /></span>
                    <?php echo ' <span class="contact-info-text""><b>Facebook:</b> <a href="mailto:'. $email . '">'. $email . '</a></span>' ?>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/instagram.png" alt="Instagram" /></span>
                    <?php echo ' <span class="contact-info-text""><b>Instagram:</b> <a href="mailto:'. $email . '">'. $email . '</a></span>' ?>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/twitter.png" alt="Twitter" /></span>
                    <?php echo ' <span class="contact-info-text""><b>Twitter:</b> <a href="mailto:'. $email . '">'. $email . '</a></span>' ?>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/skype.png" alt="Skype" /></span>
                    <?php echo ' <span class="contact-info-text""><b>Skype:</b> <a href="mailto:'. $email . '">'. $email . '</a></span>' ?>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/email.png" alt="Email" /></span>
                    <?php echo ' <span class="contact-info-text""><b>Email:</b> <a href="mailto:'. $email . '">'. $email . '</a></span>' ?>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/phone.png" alt="Phone" /></span>
                    <?php echo ' <span class="contact-info-text""><b>Phone:</b> <a href="mailto:'. $email . '">'. $email . '</a></span>' ?>
                </div>
            </div>
            
            <div>
                <p>
                    Enter Shikari are a British rock band formed in St Albans, Hertfordshire, England in 1999 under the name Hybryd by bassist Chris Batten, lead vocalist and keyboardist Roughton "Rou" Reynolds, and drummer Rob Rolfe. In 2003, guitarist Liam "Rory" Clewlow joined the band to complete its current lineup, and it adopted its current name. In 2006, they performed to a growing fanbase at Download Festival as well as a sold-out concert at the London Astoria. Their debut studio album, Take to the Skies, was released in 2007 and reached number 4 in the Official UK Album Chart, and has since been certified gold in the UK. Their second, Common Dreads, was released in 2009 and debuted on the UK Albums Chart at number 16;[2] while their third, A Flash Flood of Colour, was released in 2012 and debuted on the chart at number 4. Both have since been certified silver in the UK. The band spent a considerable amount of time supporting the latter release through the A Flash Flood of Colour World Tour, before beginning work on a fourth studio album, The Mindsweep, which was released in 2015.

                    Enter Shikari have their own record label, Ambush Reality. However, they have also signed distribution deals with several major labels to help with worldwide distribution. Their eclectic musical style combines influences from rock, especially punk rock and hardcore punk, with those from various electronic music genres.
                </p>
            </div>
        </div>        
    </div>

    <?php
        if($owner) {
            echo '<a class="button" href=/user/uploadMusicBand/'. $userName . '>Upload Music</a>';
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
