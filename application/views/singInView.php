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
    <form id="form" method="post">
        <select id="accountType" name="typeAccount">
            <option>user</option>
            <option>band</option>
        </select>
    <div>
        <table>
            <tr id="firstNameLine">
                <td>First Name:</td>
                <td><input id="firstName" type="text" name="firstName" title="First Name"/></td>
            </tr>
            <tr id="lastNameLine">
                <td>Last Name :</td>
                <td><input id="lastName" type="text" name="lastName" title="Last Name"/></td>
            </tr>
            <tr id="userNameLine">
                <td>Username:</td>
                <td><input id="userName" type="text" name="userName" title="Username"/></td>
            </tr>
            <tr id="emailNameLine">
                <td>Email: </td>
                <td><input id="email" type="email" name="email" title="Email"/></td>
            </tr>
            <tr id="reEnterEmailNameLine">
                <td>Re-enter Email:</td>
                <td><input id="reEnterEmail" type="email" name="reEnterEmail" title="Re-enter Email"/></td>
            </tr>
            <tr id="passwordUserLine">
                <td>Password:</td>
                <td><input id="passwordUser" type="password" name="password" title="Password"/></td>
            </tr>
            <tr id="userNameLine">
                <td><button type="submit" id="save" >Create an account</button></td>
            </tr>

        </table>
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