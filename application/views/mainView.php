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
<link rel="stylesheet" href="/css/tabs.css" />
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
    function callbackFocusout() {
        if($(this).val()=='') $(this).val('Enter a name or band...');
        $("#box").fadeOut(100);
        visib = false;
    }
    function callbackFocusin() {
        if($(this).val()=='Enter a name or band...') $(this).val('');
    }

    function itmclick(){
        window.location.pathname = $(this).attr("cat");
    }
    function lightTabs()
    {
        var createTabs = function(){
            tabs = this;
            i = 0;

            showPage = function(i){
                $(tabs).children("div").children("div").hide();
                $(tabs).children("div").children("div").eq(i).show();
                $(tabs).children("ul").children("li").removeClass("active");
                $(tabs).children("ul").children("li").eq(i).addClass("active");
            }

            showPage(0);

            $(tabs).children("ul").children("li").each(function(index, element){
                $(element).attr("data-page", i);
                i++;
            });

            $(tabs).children("ul").children("li").click(function(){
                showPage(parseInt($(this).attr("data-page")));
            });
        };
        return this.each(createTabs);
    }
   (function($){
       jQuery.fn.lightTabs = function(options){

           var createTabs = function(){
               tabs = this;
               i = 0;

               showPage = function(i){
                   $(tabs).children("div").children("div").hide();
                   $(tabs).children("div").children("div").eq(i).show();
                   $(tabs).children("ul").children("li").removeClass("active");
                   $(tabs).children("ul").children("li").eq(i).addClass("active");
               }

               showPage(0);

               $(tabs).children("ul").children("li").each(function(index, element){
                   $(element).attr("data-page", i);
                   i++;
               });

               $(tabs).children("ul").children("li").click(function(){
                   showPage(parseInt($(this).attr("data-page")));
               });
           };
           return this.each(createTabs);
       };
   })(jQuery);
    $(document).ready(function () {
        $("#search").on('keyup', callbackSearching);
        $("#search").on('focusout', callbackFocusout);
        $("#search").on('focusin', callbackFocusin);
        $(".tabs").lightTabs();
    });
</script>
<a href="/user/profile">Music</a>
<a href="/user/profile">Artists</a>
<div id="searchContainer">
    <input type="text" size="50" maxlength="100" autocomplete="off" id="search" value="Enter a name or band..."/>
    <div id="box"></div>
</div>

<select id="genreMusic" name="genreMusic">
    <option>Rock</option>
    <option>Classic</option>
    <option>Rap</option>
    <option>Pop</option>
    <option>Punk</option>
</select><br>

<div class="tabs">
    <ul>
        <li>Songs</li>
        <li>Bands</li>
    </ul>
    <div>
        <div>Первое содержимое</div>
        <div>Второе содержимое</div>
    </div>
</div>