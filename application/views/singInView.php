<script>
    function selectEditInformation()
    {
        if($('#accountType').val() == 'band') {
            $('#firstNameLine').hide();
            $('#lastNameLine').hide();
        } else {
            $('#firstNameLine').show();
            $('#lastNameLine').show();
        }

    }

    $(document).ready(function() {
        $('#accountType').on('change', selectEditInformation);
    });
</script>

<div id="addItem">
    <form method="post" id="form">
        <div>
            <div id="firstNameLine" style="margin-top: 20px;">
                <label for="firstName">First name</label>
                <input class="form-input" id="firstName" type="text" name="firstName" placeholder="" ="First name"/> 
            </div>
            <div id="lastNameLine" style="margin-top: 20px;">
                <label for="lastName">Last name</label>
                <input class="form-input" id="lastName" type="text" name="lastName" placeholder="Last name"/>
            </div>

            <div id="userNameLine" style="margin-top: 20px;">
                <label for="userName">User name</label>
                <input class="form-input" id="userName" type="text" name="userName" placeholder="User name"/>
            </div>
            <div id="emailNameLine" style="margin-top: 20px;">
                <label for="email">Email</label>
                <input class="form-input" id="email" type="text" name="email" placeholder="Email"/>
            </div>
            <div id="reEnterEmailNameLine" style="margin-top: 20px;">
                <label for="reEnterEmail">Re-enter email</label>
                <input class="form-input" id="reEnterEmail" type="text" name="reEnterEmail" placeholder="Email"/>
            </div>
            <div id="passwordUserLine" style="margin-top: 20px;">
                <label for="passwordUser">Password</label>
                <input class="form-input" id="passwordUser" type="text" name="passwordUser"/>
            </div>
            <button style="margin-top: 20px;" class="button" type="submit" id="save" >Sign up</button>
        </div>
    </form>
</div>

<?php extract($data); ?>
<?php
    if($signInStatus == "registrationCompletedSuccessfully") { ?>
    <p style="color:green">Регистрация прошла успешно. Пожалуйста, проверьте электронную почту</p>
<?php } elseif($signInStatus == "registrationFailed") { ?>
    <p style="color:red">Пользователь с таким логином уже существует в базе данных.</p>
<?php } elseif($signInStatus == "errorRangeUsername") { ?>
    <p style="color:red">Username должен быть не меньше 3-х символов и не больше 30.</p>
<?php }  elseif($signInStatus == "errorRangePassword") { ?>
    <p style="color:red">Пароль должен быть не меньше 6-х символов и не больше 20.</p>
<?php }  elseif($signInStatus == "errorCorrectEmail") { ?>
    <p style="color:red">Email не совпадает.</p>
<?php }  ?>