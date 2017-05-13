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

    #box {
        display:none;
        position:center;
        width:300px;
        z-index:99;
        left: auto;
        top: auto;
        margin-left:2px;
        margin-top:1px;
        background-color: #f0d0b0;
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

        if(bands.length != 0 && typeof bands[0].userName !== 'undefined'  ){
            for(var count = 0; count < bands.length; count++) {
                boxContent = boxContent + '<div class="item" cat=/user/profileBand/'+ bands[count].userName +'>'+bands[count].bandName+'</div>';
            }
        }
        if( music.length != 0 && typeof music[0].nameMusic !== 'undefined' ){
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
    function lightTabs() {
        var createTabs = function () {
            tabs = this;
            i = 0;

            showPage = function (i) {
                $(tabs).children("div").children("div").hide();
                $(tabs).children("div").children("div").eq(i).show();
                $(tabs).children("ul").children("li").removeClass("active");
                $(tabs).children("ul").children("li").eq(i).addClass("active");
            }

            showPage(0);

            $(tabs).children("ul").children("li").each(function (index, element) {
                $(element).attr("data-page", i);
                i++;
            });

            $(tabs).children("ul").children("li").click(function () {
                showPage(parseInt($(this).attr("data-page")));
            });
        };
        return this.each(createTabs);
    }
    function callbackTabs(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabs li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
        initializeBlock();
    }
    function isEmpty(value) {
        return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
    }
  /*  function clearDivSongs() {
        $('.songs').fadeOut(300, function () {
            $('.songs').removeChild();
        });
    }*/
    function updateSongsBox(items) {
   //     clearDivSongs();
        $('.songs').html('');
        for(var count = 0; count < items.length; count++) {
            var divContainer = '<div class="audio"><audio preload="auto" controls><source src="http://' + window.location.hostname +'/'
                + items[count].pathFile +  items[count].nameMusic + '" type="audio/mp3"/></audio></div>';
            $(divContainer).hide().appendTo(".songs").fadeIn(1000);
        }
    }
    function initializeBlock() {
        var type = $(".tab-link.current").text();
        var genreMusic = $("#genreMusic").val();

        if(isEmpty(type) == false && isEmpty(genreMusic) == false) {
            console.log(type + " " + genreMusic);
            $.post('/user/getBlockData', 'type=' + JSON.stringify(type) +
                '&jenre=' + JSON.stringify(genreMusic),function (data) {
                //парсим JSON
                var items = JSON.parse(data);
                // строим и выводим каркас для 10 записей
                if(type == "Songs") {
                    updateSongsBox(items);
                }
            });
        }
    }
    $(document).ready(function () {
        $("#search").on('keyup', callbackSearching);
        $("#search").on('focusout', callbackFocusout);
        $("#search").on('focusin', callbackFocusin);
        $("ul.tabs li").on('click', callbackTabs);
        $("#genreMusic").on('change', initializeBlock);
        initializeBlock();
    });
</script>
<header class="header-bg" style="background-image: url('/images/header-bg.jpg')">
    <div class="header-title">
        <h1>
            Listen to Music
        </h1>
    </div>
    <div id="searchContainer">
        <input class="music-input" type="text" size="50" maxlength="100" autocomplete="off" id="search" value="Enter a name or band..."/>
        <div id="box"></div>
    </div>
</header>
<div class="container">
    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1">Songs</li>
        <li class="tab-link" data-tab="tab-2">Artists</li>
    </ul>
    <div id="tab-1" class="tab-content current">
        <select id="genreMusic" name="genreMusic">
            <option>Rock</option>
            <option>Classic</option>
            <option>Rap</option>
            <option>Pop</option>
            <option>Punk</option>
        </select>
        <div class="songs">

        </div>
    </div>
    <div id="tab-2" class="tab-content">
        <select id="genreMusic" name="genreMusic">
            <option>Rock</option>
            <option>Classic</option>
            <option>Rap</option>
            <option>Pop</option>
            <option>Punk</option>
        </select>
        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </div>
</div>