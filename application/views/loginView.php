<script>
    function checkCapcha()
    {
        var hashSum =  $('#hiddenSHA').val();
        var valueCaptcha = parseInt($('#captcha').val());
        var sha256Class = new jsSHA(valueCaptcha.toString());
        var hashCaptha =  sha256Class.getHash("SHA-256", "HEX");
        if(hashSum === hashCaptha) {
            return true;
        }
        return false
    }
    function checkUser() {
        if($('#loginForm').valid() && checkCapcha() == true) {
            var postData = [];
            postData["userName"] = $('#login').val();
            var sha256Class = new jsSHA($('#password').val());
            postData["password"] = sha256Class.getHash("SHA-256", "HEX");
            $.ajax( {
                type: 'POST',
                url: "/login/checkUser",
                data: $.extend({}, postData),
                success: function(result) {
                    console.log(result);
                    window.location.replace(result);
                },
                error: function(result) {
                    // todo: handle error;
                },
            });
        }
    }
    // функция для генерации случайных чисел в диапазоне от m до n
    function randomNumber(m,n){
        m = parseInt(m);
        n = parseInt(n);
        return Math.floor( Math.random() * (n - m + 1) ) + m;
    };
    $(document).ready(function() {
        $('#save').on('click', checkUser);

        var aspmA = randomNumber(1,23); // генерируем число
        var aspmB = randomNumber(1,23); // генерируем число
        var sumAB = aspmA + aspmB;  // вычисляем сумму
        var sha256Class = new jsSHA(sumAB.toString());
        $('#aspm').append(aspmA + ' + ' + aspmB + ' = ' + '<input class="form-input" type="text" name="captcha" id="captcha" autocomplete="off"/>');
        $('#hiddenSHA').val(sha256Class.getHash("SHA-256", "HEX"));  // присваиваем скрытому полю name="md5" контрольную сумму
    });
</script>
<div class="login">
	<form method="post" id="loginForm">
		<div>
			<div>
				<label for="login">Login</label>
		    	<input class="form-input" type="text" name="userName" id="login" autocomplete="off"/>
			</div>
			<div style="margin-top: 20px;">
				<label for="password">Password</label>
			    <input class="form-input" type="password" name="password" id="password" autocomplete="off"/>
			</div>
            <div>
                <span id="aspm"> </span>
            </div>
            <div style="margin-top: 20px;">
                <input name="sha256" type="hidden" id="hiddenSHA">
            </div>
		    <button style="margin-top: 20px;" class="button" type="button" id="save" >Log in</button>
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

