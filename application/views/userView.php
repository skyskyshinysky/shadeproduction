<h1>Это типа страница пользователя</h1>
<?php
    extract($data);
    echo '<br>' . $Id;
    echo '<br>' . $userName;
    echo '<br>' . $firstName;
    echo '<br>' . $email;
?>
<a href="/user/logout"> Log out</a>
