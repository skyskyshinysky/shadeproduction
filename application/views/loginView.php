<h1>Страница авторизации</h1>

<form method="post">
    <input type="text" name="userName" required="required"/>
    <input type="password" name="password" required="required"/>
    <button type="submit" id="save" >Log in</button>
</form>

<?php extract($data); ?>
<?php if($login_status=="access_granted") { ?>
    <p style="color:green">Авторизация прошла успешно.</p>
<?php } elseif($login_status=="access_denied") { ?>
    <p style="color:red">Логин и/или пароль введены неверно.</p>
<?php } ?>

