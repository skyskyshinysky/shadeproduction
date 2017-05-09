<div class="login">
	<form method="post">
		<div>
			<label for="login">Login</label>
		    <input class="form-input" type="text" name="userName" id="login" required="required"/>
		    <label for="password">Password</label>
		    <input class="form-input" type="password" name="password" id="password" required="required"/>
		    <button style="margin-top: 10px;" class="button" type="submit" id="save" >Log in</button>
		</div>
	</form>
</div>

<?php extract($data); ?>
<?php if($login_status=="access_granted") { ?>
    <p style="color:green">Авторизация прошла успешно.</p>
<?php } elseif($login_status=="access_denied") { ?>
    <p style="color:red">Логин и/или пароль введены неверно.</p>
<?php } ?>

