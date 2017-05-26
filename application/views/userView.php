<script type="text/javascript">
    function sendMessageInUser() {
        var now = new Date();
        var textareaValue = $('#messageBody').val();
        var postData = [];
        postData["author"] = "Spiderman";
        postData["datetime"] = now.toISOString();
        postData["message"] = $('#messageBody').val();
        $.ajax({
            type: 'POST',
            url: "/user/sendMessage",
            data: $.extend({}, postData),
            success: function(result) {
                $('#messageBody').val('');
                if(result != undefined && result != null) {

                    var tr = $("<tr></tr>");

                    var td = $('<td></td>').attr({
                        style: 'padding: 6px 12px; vertical-align: top;',
                    });
                    var author = $("<b></b>");

                    author.text('shadeproduction');
                    author.appendTo(td);

                    var datetime = $("<td></td>").attr({
                        style: 'padding: 6px 12px; white-space: nowrap; vertical-align: top;',
                    });
                    datetime.text(now.toLocaleString());

                    var message = $("<td></td>").attr({
                        style: 'padding: 6px 12px; word-wrap: break-word; word-break: break-all;',
                    });
                    message.text(textareaValue);

                    td.appendTo(tr);
                    datetime.appendTo(tr);
                    message.appendTo(tr);

                    var tbody = $('table.wall tbody');
                    tr.prependTo(tbody);
                }
            },
            error: function(result) {
                // todo: handle error;
            },
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

                var tr = $("<tr></tr>");

                var td = $('<td></td>').attr({
                    style: 'padding: 6px 12px; vertical-align: top;',
                });
                var author = $("<b></b>");

                author.text(items[count].userName);
                author.appendTo(td);

                var datetime = $('<td></td>').attr({
                    style: 'padding: 6px 12px; white-space: nowrap; vertical-align: top;',
                });
                datetime.text(items[count].time);

                var message = $('<td></td>').attr({
                    style: 'padding: 6px 12px; word-wrap: break-word; word-break: break-all;',
                });
                message.text(items[count].message);

                td.appendTo(tr);
                datetime.appendTo(tr);
                message.appendTo(tr);

                var tbody = $('table.wall tbody');
                tr.prependTo(tbody);
            }
        });
    }

    $(document).ready(function() {
        $('#sendMessageInUser').on('click', sendMessageInUser);
        initializeComments();
    });
</script>

<?php
    extract($data);
?>

<div class="profile">
    <div style="display: inline-block; position: relative;">
        <div class="main-profile-info">
            <div class="logo-wrapper">
                <?php
                    echo '<img class="profile-image"  src="http://' . $_SERVER['HTTP_HOST']  . $logoBand['pathFile'] . $logoBand['nameLogo'] . '" />';
                ?>
            </div>
            <div>
                <?php
                    echo '<h2 style="text-align: center;" id="userName">' . $firstName . ' ' . $lastName . '</h2>';
                ?>
            </div>
            <div>
                <?php
                    echo '<h3 style="text-align: center;" id="birthday">' . '16.02.1995' . '</h3>';
                ?>
            </div>
            <div>
                <?php
                    echo '<h3 style="text-align: center;" id="male">' . $male . '</h3>';
                ?>
            </div>
            <div>
                <?php
                    echo '<h3 style="text-align: center;" id="hometown">' . $city . '</h3>';
                ?>
            </div>
            <div>
                <?php
                    echo '<h3 style="text-align: center;" id="language">' . $language . '</h3>';
                ?>
            </div>
            <?php
                if($owner) {
                    echo '<div style="position: absolute; top: 10px; right: 10px; width: 24px; height: 24px; padding: 0; margin: 0;"><a href=/user/profileEdit/'. $userName . '><img src="/images/x24/gear.png" title="Edit profile" alt="Edit profile"></a></div>';
                }
            ?>
            <div class="contact-info">
                <?php
                    if(!empty($website)) {
                        echo '<div class="contact-info-row"><span class="contact-info-img"><a href="http://' . $website . '"><img src="/images/x24/global.png" alt="Website" /></a></span></div>';
                    }
                    if(!empty($facebook)) {
                        echo '<div class="contact-info-row"><span class="contact-info-img"><a href="http://www.facebook.com/' . $facebook . '"><img src="/images/x24/facebook.png" alt="Facebook" /></a></span></div>';
                    }
                    if(!empty($instagram)) {
                        echo '<div class="contact-info-row"><span class="contact-info-img"><a href="http://www.instagram.com/' . $instagram . '"><img src="/images/x24/instagram.png" alt="Instagram" /></a></span></div>';
                    }
                    if(!empty($twitter)) {
                        echo '<div class="contact-info-row"><span class="contact-info-img"><a href="http://www.twitter.com/' . $twitter . '"><img src="/images/x24/twitter.png" alt="Twitter" /></a></span></div>';
                    }
                    if(!empty($skype)) {
                        echo '<div class="contact-info-row"><span class="contact-info-img"><a href="skype:' . $skype . '?chat"><img src="/images/x24/skype.png" alt="Skype" /></a></span></div>';
                    }
                    if(!empty($email)) {
                        echo '<div class="contact-info-row"><span class="contact-info-img"><a href="mailto:' . $email . '"><img src="/images/x24/email.png" alt="Email" /></a></span></div>';
                    }
                ?>
            </div>
        </div>
        <div class="about">
            <p style="margin: 0;">
                <?php echo trim($about); ?>
            </p>
        </div>
    </div>
    <div style="width: 100%; margin-top: 20px; position: relative;">
        <h3 style="margin: 0;">Comment area</h3>
        <table class="wall">
            <tbody>

            </tbody>
        </table>
        <ul id="page-numbers"></ul>
        <div class="center">
            <div class="pagination">
            </div>
        </div>
        <textarea class="comment-input form-input" id="messageBody" placeholder="Message Body"></textarea>
        <button style="margin-top: 10px;" onclick="sendMessageInUser"  class="button" id="sendMessageInUser">Send message</button>
    </div>
</div>
