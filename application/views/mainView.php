<style>
    #box {
        display:none;
        position:absolute;
        width:300px;
        z-index:99;
        left: auto;
        top: auto;
        margin-left:2px;
        margin-top:1px;
        background-color: #EEF2F6;
        border: 1px solid #6D8EB2;
        padding-top: 2px;
    }
    .item{
        height:18px;
        cursor:pointer;
        padding-left: 3px;
        padding-top: 2px;
        font-size:12px;
    }
    .item:hover{
        background-color: #6D8EB2;
        color:#fff;
    }

    #search {
        background: url('pics/find.png') no-repeat 1px 0px;
        border:solid 1px #6D8EB2;
        background-color: #EEF2F6;
        font-size:12px;
        padding-left:22px;
        height:22px;
    }
    #box {
        display:none;
        position:absolute;
        width:300px;
        z-index:99;
        left: auto;
        top: auto;
        margin-left:2px;
        margin-top:1px;
        background-color: #EEF2F6;
        border: 1px solid #6D8EB2;
        padding-top: 2px;
    }
    .item{
        height:18px;
        cursor:pointer;
        padding-left: 3px;
        padding-top: 2px;
        font-size:12px;
    }
    .item:hover{
        background-color: #6D8EB2;
        color:#fff;
    }

    #search {
        background: url('/data/images/find.png') no-repeat 1px 0px;
        border:solid 1px #6D8EB2;
        background-color: #EEF2F6;
        font-size:12px;
        padding-left:22px;
        height:22px;
    }
</style>
<script>

    var visib = false;
    var querySearhing;
    var ra;
    var boxContent = '';
    function getResult(){
        query = $("#search").val();
    }
    function updateBoxContent(items)
    {
        if($("#parameterSearching").val() == 'Genre Music') {
            for (var i = 0; i < Math.round(items.length/2); i++){
                boxContent = boxContent + '<div class="item" cat="'+items[0].nameMusic +'">'+items[0].nameMusic+'</div>';
            }
        } else if($("#parameterSearching").val() == 'Users') {
            for (var i = 0; i < Math.round(items.length/2); i++){
                boxContent = boxContent + '<div class="item" cat="'+items[0].userName +'">' + items[0].firstName + ' ' +items[0].lastName+'</div>';
            }
        } else {
            boxContent = boxContent + '<div class="item" cat="'+items[0].userName +'">' + items[0].bandName + '</div>';
        }

    }
    function callbackSearching(code)
    {
        if(code.keyCode == 13) {
            console.log("Enter yopta");
            getResult();
            return;
        }
        querySearhing = $("#search").val();
        queryParameterSearhing = $("#parameterSearching").val();
        if(querySearhing.length >= 3) {
            boxContent = '';
            $.post("/main/searchBox", {searchString: querySearhing ,
                parameterSearching: queryParameterSearhing},function(data){
                if(data!='') {
                    if(!visib) {
                        $("#box").fadeIn(100);
                        visib = true;
                    }
                    boxContent = '';
                    console.log(data);
                    items = JSON.parse(data);
                    updateBoxContent(items);
                    $("#box").html(boxContent);
                    $(".item").bind("click",itmclick);
                    } else {
                        $("#box").fadeOut(100);
                        visib = false;
                    }
                });
            } else {
                $("#box").fadeOut(100);
                visib = false;
            }
    }
    function callbackFocusout()
    {
        if($(this).val()=='') $(this).val('Поиск...');
        $("#box").fadeOut(100);
        visib = false;
    }
    function callbackFocusin()
    {
        if($(this).val()=='Поиск...') $(this).val('');
    }

    function itmclick(){
        if($("#parameterSearching").val() == 'Users') {
            window.location.pathname = '/user/profile/'+$(this).attr("cat");
        }else if($("#parameterSearching").val() == 'Bands') {
            window.location.pathname = '/user/profileBand/'+$(this).attr("cat");
        }else {

        }
    }
    $(document).ready(function () {
        $("#search").on('keyup', callbackSearching);
        $("#search").on('focusout', callbackFocusout);
        $("#search").on('focusin', callbackFocusin);
    });
</script>
<a href="/user/profile">Music</a>
<a href="/user/profile">Artists</a>
<input type="text" size="50" maxlength="100" autocomplete="off" id="search" value="Поиск..."/>
<select id="parameterSearching" name="parameterSearching">
    <option>Genre Music</option>
    <option>Users</option>
    <option>Bands</option>
</select>
<div id="box"></div>
