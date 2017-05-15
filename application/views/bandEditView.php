<script>
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    function sendMessageEditMail() {
        var data = $('#email').val();
        if(isEmail(data) == true){
            $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMessageEditMail",
                data: 'message=' + JSON.stringify($('#email').val()),
                success: function(result) {
                    //$('#email').text(data);
                },
                error: function(result) {

                },
                processData: false,
                async: false
            });
        }
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
    function callbackFocusoutRenameBand() {
        if($(this).val()=='') $(this).val('Name band...');
    }
    function callbackFocusinRenameBand() {
        if($(this).val()=='Name band...') $(this).val('');
    }
    function callbackFocusoutEmail() {
        if($(this).val()=='') $(this).val('Email...');
    }
    function callbackFocusinEmail() {
        if($(this).val()=='Email...') $(this).val('');
    }
    function callbackFocusoutPhone() {
        if($(this).val()=='') $(this).val('Phone...');
    }
    function callbackFocusinPhone() {
        if($(this).val()=='Phone...') $(this).val('');
    }
    function callbackFocusoutSkype() {
        if($(this).val()=='') $(this).val('Skype...');
    }
    function callbackFocusinSkype() {
        if($(this).val()=='Skype...') $(this).val('');
    }
    function callbackFocusoutTwitter() {
        if($(this).val()=='') $(this).val('Twitter...');
    }
    function callbackFocusinTwitter() {
        if($(this).val()=='Twitter...') $(this).val('');
    }
    function callbackFocusoutInstagram() {
        if($(this).val()=='') $(this).val('Instagram...');
    }
    function callbackFocusinInstagram() {
        if($(this).val()=='Instagram...') $(this).val('');
    }
    function callbackFocusoutFacebook() {
        if($(this).val()=='') $(this).val('Facebook...');
    }
    function callbackFocusinFacebook() {
        if($(this).val()=='Facebook...') $(this).val('');
    }
    function callbackFocusoutWebsite() {
        if($(this).val()=='') $(this).val('Website...');
    }
    function callbackFocusinWebsite() {
        if($(this).val()=='Website...') $(this).val('');
    }
    function sendMessageAboutBand() {
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: "/user/sendMessageAboutBand",
            data: 'message=' + JSON.stringify($('#messageAboutBand').val()),
            success: function(result) {
                //todo: handle succes;
            },
            error: function(result) {
                // todo: handle error;
            },
            processData: false,
            async: false
        });
    }
    function validatePhone(number) {
        var filter = /^[0-9-+]+$/;
        return filter.test(number);
    }
    function sendMesssageEditSkype()
    {
        $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMesssageEditSkype",
                data: 'message=' + JSON.stringify($('#skype').val()),
                success: function(result) {
                    $('#spnSkypeStatus').html('Edited!');
                    $('#spnSkypeStatus').css('color', 'green');

                },
                error: function(result) {
                    $('#spnPhoneStatus').html('Invalid');
                    $('#spnPhoneStatus').css('color', 'red');
                },
                processData: false,
                async: false
        });
    }
    function sendMesssageEditPhone()
    {
        console.log(validatePhone($('#phone').val()));
        if(validatePhone($('#phone').val())) {
            $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMesssageEditPhone",
                data: 'message=' + JSON.stringify($('#phone').val()),
                success: function(result) {
                    $('#spnPhoneStatus').html('Edited!');
                    $('#spnPhoneStatus').css('color', 'green');

                },
                error: function(result) {
                    // todo: handle error;
                },
                processData: false,
                async: false
            });
        }else {
            $('#spnPhoneStatus').html('Invalid');
            $('#spnPhoneStatus').css('color', 'red');
        }
    }
    function sendMesssageEditTwitter()
    {
            $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMesssageEditTwitter",
                data: 'message=' + JSON.stringify($('#twitter').val()),
                success: function(result) {
                    $('#spnTwitterStatus').html('Edited!');
                    $('#spnTwitterStatus').css('color', 'green');

                },
                error: function(result) {
                    $('#spnPhoneStatus').html('Invalid');
                    $('#spnPhoneStatus').css('color', 'red');
                },
                processData: false,
                async: false
            });
    }
    function sendMesssageEditInstagram()
    {
        $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMesssageEditInstagram",
                data: 'message=' + JSON.stringify($('#instagram').val()),
                success: function(result) {
                    $('#spnInstagramStatus').html('Edited!');
                    $('#spnInstagramStatus').css('color', 'green');

                },
                error: function(result) {
                    $('#spnPhoneStatus').html('Invalid');
                    $('#spnPhoneStatus').css('color', 'red');
                },
                processData: false,
                async: false
        });
    }
    function sendMesssageEditFacebook()
    {
        $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMesssageEditFacebook",
                data: 'message=' + JSON.stringify($('#facebook').val()),
                success: function(result) {
                    $('#spnFacebookStatus').html('Edited!');
                    $('#spnFacebookStatus').css('color', 'green');

                },
                error: function(result) {
                    $('#spnPhoneStatus').html('Invalid');
                    $('#spnPhoneStatus').css('color', 'red');
                },
                processData: false,
                async: false
            });
    }
    function sendMesssageEditWebsite()
    {
        $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMesssageEditWebsite",
                data: 'message=' + JSON.stringify($('#website').val()),
                success: function(result) {
                    $('#spnWebsiteStatus').html('Edited!');
                    $('#spnWebsiteStatus').css('color', 'green');

                },
                error: function(result) {
                    $('#spnPhoneStatus').html('Invalid');
                    $('#spnPhoneStatus').css('color', 'red');
                },
                processData: false,
                async: false
            });
    }
    function initializeCallback() {
        $("#renameBand").on('focusout', callbackFocusoutRenameBand);
        $("#renameBand").on('focusin', callbackFocusinRenameBand);
        $("#email").on('focusout', callbackFocusoutEmail);
        $("#email").on('focusin', callbackFocusinEmail);
        $("#phone").on('focusout', callbackFocusoutPhone);
        $("#phone").on('focusin', callbackFocusinPhone);
        $("#skype").on('focusout', callbackFocusoutSkype);
        $("#skype").on('focusin', callbackFocusinSkype);
        $("#twitter").on('focusout', callbackFocusoutTwitter);
        $("#twitter").on('focusin', callbackFocusinTwitter);
        $("#instagram").on('focusout', callbackFocusoutInstagram);
        $("#instagram").on('focusin', callbackFocusinInstagram);
        $("#facebook").on('focusout', callbackFocusoutFacebook);
        $("#facebook").on('focusin', callbackFocusinFacebook);
        $("#website").on('focusout', callbackFocusoutWebsite);
        $("#website").on('focusin', callbackFocusinWebsite);
    }
    $(document).ready(function() {
        initializeCallback();
        $('#sendMessageRenameBand').on('click', sendMessageRenameBand);
        $('#editMail').on('click', sendMessageEditMail);
        $('#sendMessageAboutBand').on('click', sendMessageAboutBand);
        $('#sendMesssageEditPhone').on('click', sendMesssageEditPhone);
        $('#sendMesssageEditSkype').on('click', sendMesssageEditSkype);
        $('#sendMesssageEditTwitter').on('click', sendMesssageEditTwitter);
        $('#sendMesssageEditInstagram').on('click', sendMesssageEditInstagram);
        $('#sendMesssageEditFacebook').on('click', sendMesssageEditFacebook);
        $('#sendMesssageEditWebsite').on('click', sendMesssageEditWebsite);
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
                    <span class="contact-info-text""><b>Website:</b>
                        <input type="text" size="30" maxlength="70" autocomplete="off" id="website" value="Website..."/>
                        <button id="sendMesssageEditWebsite">Edit website</button>
                    </span>
                    <span id="spnWebsiteStatus"></span>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/facebook.png" alt="Facebook" /></span>
                    <span class="contact-info-text""><b>Facebook:</b>
                        <input type="text" size="30" maxlength="70" autocomplete="off" id="facebook" value="Facebook..."/>
                        <button id="sendMesssageEditFacebook">Edit facebook</button>
                    </span>
                    <span id="spnFacebookStatus"></span>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/instagram.png" alt="Instagram" /></span>
                    <span class="contact-info-text""><b>Instagram:</b>
                        <input type="text" size="30" maxlength="70" autocomplete="off" id="instagram" value="Instagram..."/>
                        <button id="sendMesssageEditInstagram">Edit instagram</button>
                    </span>
                    <span id="spnInstagramStatus"></span>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/twitter.png" alt="Twitter" /></span>
                    <span class="contact-info-text""><b>Twitter:</b>
                        <input type="text" size="30" maxlength="70" autocomplete="off" id="twitter" value="Twitter..."/>
                        <button id="sendMesssageEditTwitter">Edit twitter</button>
                    </span>
                    <span id="spnTwitterStatus"></span>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/skype.png" alt="Skype" /></span>
                    <span class="contact-info-text""><b>Skype:</b>
                        <input type="text" size="30" maxlength="70" autocomplete="off" id="skype" value="Skype..."/>
                        <button id="sendMesssageEditSkype">Edit skype</button>
                    </span>
                    <span id="spnSkypeStatus"></span>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/email.png" alt="Email" /></span>
                    <span class="contact-info-text""><b>Email:</b>
                        <input type="text" size="30" maxlength="70" autocomplete="off" id="email" value="Email..."/>
                        <button id="editMail">Edit mailbox</button>
                    </span>
                </div>
                <div class="contact-info-row">
                    <span class="contact-info-img"><img src="/images/x24/phone.png" alt="Phone" /></span>
                    <span class="contact-info-text""><b>Phone:</b>
                        <input type="text" size="30" maxlength="70" autocomplete="off" id="phone" value="Phone..."/>
                        <button id="sendMesssageEditPhone">Edit phone</button>
                    </span>
                    <span id="spnPhoneStatus"></span>
                </div>
            </div>
            <div>
                <textarea id="messageAboutBand" placeholder="About band"></textarea><button id="sendMessageAboutBand">Edit about band information</button>
            </div>
        </div>
    </div>

    <?php
    if($owner) {
        echo '<a class="button" href=/user/uploadMusicBand/'. $userName . '>Upload Music</a>';
        echo '<form action="http://' . $_SERVER['HTTP_HOST'] . '/user/profileBandEdit/' . $userName . '" method="post" enctype="multipart/form-data" >';
    }
    ?>
    <table>
        <tr>
            <td><input type="file" name="uploadFileLogo" /></td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" value="Upload"/></td>
        </tr>
    </table>
    <?php echo '</form>'; ?>
    <input type="text" size="30" maxlength="70" autocomplete="off" id="renameBand" value="Name band..."/>
    <select id="genreMusic" name="genreMusic">
        <option>Rock</option>
        <option>Classic</option>
        <option>Rap</option>
        <option>Pop</option>
        <option>Punk</option>
    </select><button id="sendMessageRenameBand">Edit band</button>
</div>