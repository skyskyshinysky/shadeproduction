
<script type="text/javascript">
    function sendRequest() {
        var userName = $('#username').val();
        var passwordUsername = $('#passwordUsername').val();
        $.ajax({
                type: "post",
                dataType: 'json',
                url: '/login/validate',
                data: {'username' : JSON.stringify(userName), 'password' : JSON.stringify(passwordUsername)},
                success: function (result) {
                    if(result == 'true') {
                        console.log(result);
                        console.log("success");
                    }
                },
                error: function (result) {
                    console.log("unsucces");
                }
            });
    }
    $(document).ready(function() {
        console.log("clickqweqwe!");
        $('#save').on('click', sendRequest);
    });
</script>

<h1>Страница авторизации</h1>

<form id="form">
    <input id = "username" type="text" name="username" required="required"/>
    <input id = "passwordUsername" type="password" name="password" required="required"/>
    <button type="button" id="save" >Save</button>
</form>

