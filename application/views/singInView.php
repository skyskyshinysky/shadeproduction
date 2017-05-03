<form id="form" method="post">
    First Name: <input type="text" name="firstName" title="First Name"/> <br>
    Last Name : <input  type="text" name="lastName" title="Last Name"/> <br>
    Email: <input type="email" name="email" title="Email"/> <br>
    Re-enter Email: <input type="email" name="reEnterEmail" title="Re-enter Email"/> <br>
    Username: <input type="text" name="userName" title="Username"/> <br>
    Password: <input type="password" name="password" title="Password"/> <br>
    <button type="submit" id="save" >Create an account</button>
</form>
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