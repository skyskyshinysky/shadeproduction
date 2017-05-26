<div class="login">
	<form method="post" id="loginForm">
		<div>
			<div>
				<label for="login">Login</label>
		    	<input class="form-input" type="text" name="userName" id="login"/>	
			</div>
			<div style="margin-top: 20px;">
				<label for="password">Password</label>
			    <input class="form-input" type="password" name="password" id="password" autocomplete="off"/>
			</div>
		    <button style="margin-top: 20px;" class="button" type="submit" id="save" >Log in</button>
		</div>
	</form>
</div>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('#loginForm').validate({
			rules: {
				userName: {
					required: true
				},
				password: {
					required: true
				}
			},
			messages: {
				userName: {
					required: "Please enter your login"
				},
				password: {
					required: "Please enter your password"
				}
  			},
		});
	});
</script>

<?php extract($data); ?>
<?php if($login_status=="access_granted") { ?>
    <p style="color:green">Авторизация прошла успешно.</p>
<?php } elseif($login_status=="access_denied") { ?>
    <p style="color:red">Логин и/или пароль введены неверно.</p>
<?php } ?>

