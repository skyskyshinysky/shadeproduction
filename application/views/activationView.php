<h1>Тут типа страница активации</h1>
<a href="/login">Log in</a>

<?php extract($data); ?>
<?php if($activationStatus == "activationCompletedSuccessfully") { ?>
    <p style="color:green">Вы успешно подтвердили электронную почту</p>
<?php } elseif($activationStatus == "activationFailed") { ?>
    <p style="color:red">Ошибка подтверждения электронной почтыы.</p>
<?php } ?>