<?php
    extract($data);
?>

<div class="profile">
    <div style="display: inline-block; position: relative;">
        <?php
        if($owner) {
            echo '<div style="position: absolute; top: 0px; right: 20px; width: 24px; height: 24px; padding: 0; margin: 0;"><a href=/user/profileEdit/'. $userName . '><img src="/images/x24/gear.png" alt="Edit profile"></a></div>';
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
                echo '<h2 style="text-align: center;" id="nameUser">' . $firstName . ' ' . $lastName . '</h2>';
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
                    <?php echo $about; ?>
                </p>
            </div>
        </div>
    </div>