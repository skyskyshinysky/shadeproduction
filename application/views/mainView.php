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
        background: url('/data/images/find.png') no-repeat 1px 0px;
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
    function updateBoxContent(bands, music)
    {
        if(typeof bands[0].userName !== 'undefined'){
            for(var count = 0; count < bands.length; count++) {
                boxContent = boxContent + '<div class="item" cat=/user/profileBand/'+ bands[count].userName +'>'+bands[count].bandName+'</div>';
            }
        }
        if(typeof music[0].nameMusic !== 'undefined'){
            for(var count = 0; count < music.length; count++) {
                boxContent = boxContent + '<div class="item" cat="'+ music[count].nameMusic +'">'+music[count].nameMusic+'</div>';
            }
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
        if(querySearhing.length >= 3) {
            boxContent = '';
            $.post("/main/searchBox", {searchString: querySearhing},function(data){
                if(data!='') {
                    if(!visib) {
                        $("#box").fadeIn(100);
                        visib = true;
                    }
                    boxContent = '';
                    items = JSON.parse(data);
                    bands = $.map(items,function (val, bands) {
                        return val;
                    });
                    music = $.map(items,function (val, music) {
                        return val;
                    });
                    updateBoxContent(bands, music);
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
        if($(this).val()=='') $(this).val('Enter a name or band...');
        $("#box").fadeOut(100);
        visib = false;
    }
    function callbackFocusin()
    {
        if($(this).val()=='Enter a name or band...') $(this).val('');
    }

    function itmclick(){
        window.location.pathname = $(this).attr("cat");
    }
    
    $(document).ready(function () {
        $("#search").on('keyup', callbackSearching);
        $("#search").on('focusout', callbackFocusout);
        $("#search").on('focusin', callbackFocusin);
    });
</script>
<a href="/user/profile">Music</a>
<a href="/user/profile">Artists</a>
<input type="text" size="50" maxlength="100" autocomplete="off" id="search" value="Enter a name or band..."/>
<select id="genreMusic" name="genreMusic">
    <option>Rock</option>
    <option>Classic</option>
    <option>Rap</option>
    <option>Pop</option>
    <option>Punk</option>
</select>
<div id="box"></div>
