<script>
    function isEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        return regex.test(email);
    }
    function sendMessageEditMail() {
        var data = $('#email').val();
        if(isEmail(data) == true){
            $.ajax({
                type: 'POST',
                dataType: 'text',
                url: "/user/sendMessageEditMail",
                data: 'message=' + JSON.stringify($('#email').val()),
                success: function(result) {
                    //$('#email').text(data);
                },
                error: function(result) {

                },
                processData: false,
                async: false
            });
        }
    }
    function sendMessageRenameBand()
    {
        var data = $('#renameBand').val();
        $.ajax({
            type: 'POST',
            dataType: 'text',
            url: "/user/sendMessageRenameBand",
            data: 'message=' + JSON.stringify($('#renameBand').val()) + '&jenre=' + JSON.stringify($('#genreMusic').val()),
            success: function(result) {
                $('#nameBand').text(data);
            },
            error: function(result) {
                // todo: handle error;
            },
            processData: false,
            async: false
        });
    }
    function callbackFocusout()
    {
        if($(this).val()=='') $(this).val('Name band...');
        $("#box").fadeOut(100);
        visib = false;
    }
    function callbackFocusin()
    {
        if($(this).val()=='Name band...') $(this).val('');
    }
    $(document).ready(function() {
        $("#renameBand").on('focusout', callbackFocusout);
        $("#renameBand").on('focusin', callbackFocusin);
        $('#sendMessageRenameBand').on('click', sendMessageRenameBand);
        $('#editMail').on('click', sendMessageEditMail);
    });
</script>
<?php
    extract($data);
    echo '<h1>Это типа страница редактирования банды <p id="nameBand">' . $bandName . '</p></h1>
    <img src="http://' . $_SERVER['HTTP_HOST']  . $logoBand['pathFile'] . $logoBand['nameLogo'] . '" alt="Logo"><br>';
    echo '<form action="http://' . $_SERVER['HTTP_HOST'] . '/user/profileBand/' . $userName . '" method="post" enctype="multipart/form-data" >';
?>
<table>
    <tr>
        <td><input type="file" name="uploadFileLogo" /></td>
    </tr>
    <tr>
        <td><input type="submit" name="submit" value="Upload"/></td>
    </tr>
</table>
<?php
    echo '</form><br>';
    if($owner) {
        echo '<input type="text" size="30" maxlength="70" autocomplete="off" id="email" value="Email..."/>
            <button id="editMail">Edit mailbox</button><br>
            <input type="text" size="30" maxlength="70" autocomplete="off" id="renameBand" value="Name band..."/>
            <select id="genreMusic" name="genreMusic">
                    <option>Rock</option>
                    <option>Classic</option>
                    <option>Rap</option>
                    <option>Pop</option>
                    <option>Punk</option>
            </select><button id="sendMessageRenameBand">Edit band</button>';
        echo '<a href=/user/uploadMusicBand/'. $userName . '>Upload Music</a><br>';
    }


