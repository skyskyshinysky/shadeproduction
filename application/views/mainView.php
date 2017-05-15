<style>
    #box {
        display:none;
        background-color: #EEF2F6;
        border: 1px solid #6D8EB2;
        margin: auto;
        left: auto;
        top: auto;
        width: 300px;
        z-index:99;
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

    .artists{width:950px; margin:0 auto;}
    .artists a:link{text-decoration:none;}
    .artists article{ float:left; width:157px; height:157px; }

    .fdw-background{ background-color:rgba(0,0,0,0.6);opacity:0; margin-top:-14px; width:100%; height:100%; }
    .fdw-background .fdw-port{ text-align:center; padding:70px 40px 0; }
    .fdw-background .fdw-port a{ padding:8px 15px; font-size:1em; }

    .fdw-subtitle a{ color:#F90; }
    /*columns*/
    .c-two{ width:314px !important; }

    /*link buttons*/
    .fdw-port a{
        background-color:#336699;
        color:#fff;
        border-radius:3px;
        -moz-border-radius:3px;
        -webkit-border-radius:3px;
        -o-border-radius:3px;
        -webkit-box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
        -moz-box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
        box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
        -o-box-shadow: 0 3px 0 #0f3963, 3px 5px 3px #333;
        text-shadow:0 1px 1px #000;
    }
    .fdw-port a:hover{
        background-color:#f2f2f2;
        color:#336699 !important;
        text-shadow:0 1px 1px #ccc;
        -webkit-box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
        -moz-box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
        box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
        -o-box-shadow: 0 3px 0 #ccc, 3px 5px 3px #333;
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
    function updateBoxContent(items) {
        if (items.length != 0) {
            for (var count = 0; count < items.length; count++) {
                if (typeof items[count].bandName !== 'undefined') {
                    boxContent = boxContent + '<div class="item" cat=/user/profileBand/' + items[count].userName + '>' + items[count].bandName + '</div>';
                } else {
                    boxContent = boxContent + '<div class="item" cat="/user/profileBand/' + items[count].userName + '">' + items[count].nameMusic.replace(/[\d\.\.mp3]+/g,"") + '</div>';
                }
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
                    items = $.map(items,function (val, bands) {
                        return val;
                    });
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
    function updateSongsBox(items) {
        $('.songs').html('');
        for(var count = 0; count < items.length; count++) {
            var divContainer = '<div>' + items[count].nameMusic.replace(/[\d\.\.mp3]+/g,"") + ' - ' + items[count].bandName +
                '<audio preload="auto" controls><source src="http://' + window.location.hostname +'/'
                + items[count].pathFile +  items[count].nameMusic + '" type="audio/mp3"/></audio></div>';
            $(divContainer).hide().appendTo(".songs").fadeIn(600);
        }
        $( 'audio' ).audioPlayer();
    }
    function updateArtistsBox(items) {
        $('.artists').html('');
        console.log(items);
        for(var count = 0; count < items.length; count++) {
            var divContainer='<article class="c-two" style="background-image:url(' + items[count].pathFile + items[count].nameLogo + ');background-size: cover"> ' +
                '<div class="fdw-background"> <p class="fdw-port"> <a href="http://'+ window.location.hostname +'/'+
                'user/profileBand/' + items[count].userName + '">' +  items[count].bandName + '</a></p></div></article>';
            $(divContainer).hide().appendTo('.artists').fadeIn(1000);
        }
        $('.fdw-background').hover(
            function () {
                $(this).animate({opacity:'1'});
            },
            function () {
                $(this).animate({opacity:'0'});
            }
        );
    }
    function initializeBlock() {
        var type = $(".tab-link.current").text();
        var genreMusic = $("#genreMusic").val();
        console.log(genreMusic);
        if(isEmpty(type) == false && isEmpty(genreMusic) == false) {
            $.post('/user/getBlockData', 'type=' + JSON.stringify(type) +
                '&jenre=' + JSON.stringify(genreMusic),function (data) {
                //парсим JSON
                var items = JSON.parse(data);
                // строим и выводим каркас для 10 записей
                if(type == "Songs") {
                    updateSongsBox(items);
                } else if(type == "Artists") {
                    updateArtistsBox(items);
                }
            });
        }
    }
    function callbackFDW() {

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
        <input class="form-input music-input" type="text" size="50" maxlength="100" autocomplete="off" id="search" value="Enter a name or band..."/>
        <div id="box"></div>
    </div>
</header>
<div class="container">
    <select id="genreMusic" class="musicGenre" name="genreMusic">
        <option>Rock</option>
        <option>Classic</option>
        <option>Rap</option>
        <option>Pop</option>
        <option>Punk</option>
    </select>
    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1">Songs</li>
        <li class="tab-link" data-tab="tab-2">Artists</li>
    </ul>
    <div id="tab-1" class="tab-content current">
        <div class="songs">
        </div>
    </div>
    <div id="tab-2" class="tab-content">
        <div class="artists">
        </div>
    </div>
</div>

