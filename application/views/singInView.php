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
        <div style="margin-top: 20px;">
            <select class="form-input" id="accountType" name="typeAccount">
                <option>user</option>
                <option>band</option>
            </select>
            <div id="firstNameLine" style="margin-top: 20px;">
                <label for="firstName">First name</label>
                <input class="form-input" id="firstName" type="text" name="firstName" placeholder="First name"/>
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
                <input class="form-input" id="passwordUser" type="password" name="passwordUser" placeholder="Password"/>
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

<script type="text/javascript">
        jQuery(document).ready(function($) {
            $.validator.addMethod("passwordCheck", function(value, element) {
                return value.trim() != "" && /^[A-Za-z0-9\d=!\-@._*]*$/.test(value)
                   && /[a-z]/.test(value)
                   && /\d/.test(value)
            }, "Password must have a lowecase and uppercase letters and digit...")
            $.validator.addMethod("reEnterEmailCheck", function(value, element) {
                return value == $("#email").val();
            }, "Please enter same email...")
            $('#form').validate({
                rules: {
                    firstName: {
                        required: true,
                        maxlength: 50
                    },
                    lastName: {
                        required: true,
                        maxlength: 50
                    },
                    userName: {
                        required: true,
                        maxlength: 30
                    },
                    email: {
                        email: true,
                        required: true
                    },
                    reEnterEmail: {
                        email: true,
                        required: true,
                        reEnterEmailCheck: true
                    },
                    passwordUser: {
                        passwordCheck: true,
                        minlength: 6,
                        maxlength: 20
                    }
                },
                messages: {
                    firstName: {
                        required: "Please enter your first name...",
                        maxlength: "First name must have a maximum 50 symbols..."
                    },
                    lastName: {
                        required: "Please enter your last name...",
                        maxlength: "Last name must have a maximum 50 symbols..."
                    },
                    userName: {
                        required: "Please enter your login...",
                        maxlength: "Login name must have a maximum 30 symbols..."
                    },
                    email: {
                        email: "Please enter correct email address...",
                        required: "Please enter email..."
                    },
                    reEnterEmail: {
                        email: "Please enter correct email address...",
                        required: "Please enter email..."
                    },
                    passwordUser: {
                        minlength: "Password must have a minimum 6 and maximum 10 simbols...",
                        maxlength: "Password must have a minimum 6 and maximum 10 simbols..."
                    }
                },
            });
    });
</script>
