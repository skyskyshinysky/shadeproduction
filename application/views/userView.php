<?php
    extract($data);
?>

<div class="profile">
    <div style="display: inline-block; position: relative;">
        <div class="main-profile-info">
            <div class="logo-wrapper">
                <?php
                    echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . $logoBand['pathFile'] . $logoBand['nameLogo'] . '" />';
                ?>
            </div>
            <div>
                <?php
                    echo '<h2 style="text-align: center;" id="nameBand">' . $firstName .  ' ' . $lastName . '</h2>';
                ?>
            </div>
            <div>
                <?php
                    echo '<h3 style="text-align: center;" id="genreMusic">' .$genreMusic . '</h3>';
                ?>
            </div>
            <div>
                <?php
                    echo '<h3 style="text-align: center;" id="origin">' . $origin . '</h3>';
                ?>
            </div>
            <?php
            if($owner) {
                echo '<div style="position: absolute; top: 10px; right: 10px; width: 24px; height: 24px; padding: 0; margin: 0;"><a href=/user/profileEdit/'. $userName . '><img src="/images/x24/gear.png" alt="Edit profile"></a></div>';
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
                <?php echo $about; ?>
            </p>
        </div>
    </div>
</div>