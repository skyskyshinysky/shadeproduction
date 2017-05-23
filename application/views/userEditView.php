<?php
    extract($data);
?>
<form method="post" id="editUser" enctype="multipart/form-data" <?php echo 'action="/user/profileEdit/'. $userName . '"'; ?> >
    <input name="token" type="hidden" value="<?php echo $_COOKIE['Hash'] ?>" />
<div class="profile">
    <div style="display: inline-block; position: relative;">
        <div class="main-profile-info">
            <div class="logo-wrapper">
                <?php
                    echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . $logoBand['pathFile'] . $logoBand['nameLogo'] . '" />';
                ?>
            </div>
            <div style="margin-top: 20px;">
                <label class="button"> 
                    Select profile image file...
                    <input type="file" name="uploadFileLogo" style="display: none;" />
                </label>
            </div>
            <div style="margin-top: 20px;">
                <?php
                    echo '<input class="form-input" name="firstName" style="text-align: center; max-width: 100%;" id="nameBand" placeholder="First Name" value="' . $firstName . '" />';
                ?>
            </div>
            <div style="margin-top: 20px;">
                <?php
                    echo '<input class="form-input" name="lastName" style="text-align: center; max-width: 100%;" id="nameBand" placeholder="Last Name" value="' . $lastName . '" />';
                ?>
            </div>
            <div style="margin-top: 20px;">
                <select class="form-input" id="male" name="male" style="max-width: 100%; text-align: center;">
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
            <div style="margin-top: 20px;">
                <?php
                    echo '<input class="form-input" name="hometown" style="text-align: center; max-width: 100%;" id="nameBand" placeholder="Hometown" value="' . 'Votkinsk' . '" />';
                ?>
            </div>
            <div style="margin-top: 20px;">
                <?php
                    echo '<input class="form-input" name="language" style="text-align: center; max-width: 100%;" id="nameBand" placeholder="Language" value="' . 'Russian' . '" />';
                ?>
            </div>
        </div>
         <div class="contact-info">
            <h3 style="margin: 0;">Contact info</h3>
            <div class="contact-info-row" style="margin-left: 0; margin-top: 10px;">
                <span style="float: left;">
                    <input class="form-input" name="website" type="text" size="30" maxlength="70" autocomplete="off" id="website" placeholder="Website..."
                        <?php if(!empty($website)) {
                            echo 'value = ' . $website;
                        } ?>
                    />
                </span>
                <span class="contact-info-img" style="float: left; margin-left: 10px; margin-top: 2px"><img src="/images/x24/global.png" alt="Website" /></span>
            </div>
            <div class="contact-info-row" style="margin-left: 0; margin-top: 10px;">
                <span style="float: left;">
                    <input class="form-input" name="facebook" type="text" size="30" maxlength="70" autocomplete="off" id="facebook" placeholder="Facebook..."
                        <?php if(!empty($facebook)) {
                            echo 'value = ' . $facebook;
                        } ?>
                    />
                </span>
                <span class="contact-info-img" style="float: left; margin-left: 10px; margin-top: 2px"><img src="/images/x24/facebook.png" alt="Facebook" /></span>
            </div>
            <div class="contact-info-row" style="margin-left: 0; margin-top: 10px;">
                <span style="float: left;">
                    <input class="form-input" name="instagram" type="text" size="30" maxlength="70" autocomplete="off" id="instagram" placeholder="Instagram..."
                        <?php if(!empty($instagram)) {
                            echo 'value = ' . $instagram;
                        } ?>
                    />
                </span>
                <span class="contact-info-img" style="float: left; margin-left: 10px; margin-top: 2px"><img src="/images/x24/instagram.png" alt="Instagram" /></span>
            </div>
            <div class="contact-info-row" style="margin-left: 0; margin-top: 10px;">
                <span style="float: left;">
                    <input class="form-input" name="twitter" type="text" size="30" maxlength="70" autocomplete="off" id="twitter" placeholder="Twitter..."
                        <?php if(!empty($twitter)) {
                            echo 'value = ' . $twitter;
                        } ?>
                    />
                </span>
                <span class="contact-info-img" style="float: left; margin-left: 10px; margin-top: 2px"><img src="/images/x24/twitter.png" alt="Twitter" /></span>
            </div>
            <div class="contact-info-row" style="margin-left: 0; margin-top: 10px;">
                <span style="float: left;">
                    <input class="form-input" name="skype" type="text" size="30" maxlength="70" autocomplete="off" id="skype" placeholder="Skype..."
                        <?php if(!empty($skype)) {
                            echo 'value = ' . $skype;
                        } ?>
                    />
                </span>
                <span class="contact-info-img" style="float: left; margin-left: 10px; margin-top: 2px"><img src="/images/x24/skype.png" alt="Skype" /></span>
            </div>
            <div class="contact-info-row" style="margin-left: 0; margin-top: 10px;">
                <span style="float: left;">
                    <input class="form-input email" name="email" type="text" size="30" maxlength="70" autocomplete="off" id="email" placeholder="Email..."
                        <?php if(!empty($email)) {
                            echo 'value = ' . $email;
                        } ?>
                    />
                </span>
                <span class="contact-info-img" style="float: left; margin-left: 10px; margin-top: 2px"><img src="/images/x24/email.png" alt="Email" /></span>
            </div>
        </div>
    </div>
    <div style="width: 100%; margin-top: 20px; position: relative;">
        <div class="about">
            <textarea class="comment-input form-input" style="height: 200px;" name="aboutUser" id="aboutUser" placeholder="About"><?php if(!empty(trim($about))) { echo trim($about); } ?></textarea>
        </div>
    </div>
    <input style="margin-top: 20px;" class="button" type="submit" name="save" value="Save" />
</div>
</form>

<script type="text/javascript">
        jQuery(document).ready(function($) {
            $.validator.addMethod("aboutBand", function(value, element) {
                return value.trim() != "";
        }, "Please enter info about...")
        $('#editUser').validate({
            rules: {
                firstName: {
                    required: true
                },
                lastName: {
                    required: true
                },
                hometown: {
                    required: true
                },
                language: {
                    required: true
                },
                aboutBand: {
                    aboutBand: true
                },
                email: {
                    email: true
                },
            },
            messages: {
                firstName: {
                    required: "Please enter your first name..."
                },
                lastName: {
                    required: "Please enter your last name..."
                },
                hometown: {
                    required: "Please enter your hometown..."
                },
                language: {
                    required: "Please enter your language..."
                },
                email: {
                    email: "Please enter correct email address..."
                },
            },
        });
    });
</script>
