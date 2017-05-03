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
<?php if($signInStatus == "registrationCompletedSuccessfully") { ?>
    <p style="color:green">Регистрация прошла успешно. Пожалуйста, проверьте электронную почту</p>
<?php } elseif($signInStatus == "registrationFailed") { ?>
    <p style="color:red">Логин и/или пароль введены неверно.</p>
<?php } ?>