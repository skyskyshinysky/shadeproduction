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
                    boxContent = boxContent + '<tr class="search-row"><td class="item" cat=/user/profileBand/' + items[count].userName + '>' + items[count].bandName + '</td><tr>';
                } else {
                    boxContent = boxContent + '<tr class="search-row"><td class="item" cat="/user/profileBand/' + items[count].userName + '">' + items[count].nameMusic.replace(/[\d\.\.mp3]+/g,"") + '</td><tr>';
                }
            }
        }
    }
    function callbackSearching(code)
    {
        if(code.keyCode == 13) {
            getResult();
            return;
        }
        $("#box").children().not(":first()").remove();

        querySearhing = $("#search").val();
        if(querySearhing.length >= 3) {
            boxContent = '';
            $.post("/main/searchBox", {searchString: querySearhing},function(data){
                if(data!='') {
                    boxContent = '';
                    items = JSON.parse(data);
                    items = $.map(items,function (val, bands) {
                        return val;
                    });
                    updateBoxContent(items);
                    $("#box").append(boxContent);
                    $(".item").bind("click",itmclick);
                    } 
                });
            }
    }
    function callbackFocusout() {
        if($(this).val()=='') $(this).val('Enter a name or band...');
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
            var divContainer = '<div><h3>' + items[count].nameMusic.replace(/[\d\.\.mp3]+/g,"") + ' - ' + items[count].bandName +
                '</h3><audio preload="auto" controls><source src="http://' + window.location.hostname +'/'
                + items[count].pathFile +  items[count].nameMusic + '" type="audio/mp3"/></audio></div>';
            $(divContainer).hide().appendTo(".songs").fadeIn(600);
        }
        $( 'audio' ).audioPlayer();
    }
    function updateArtistsBox(items) {
        $('.artists').html('');
        console.log(items);
        var row = $('<tr></tr>');
        for(var count = 0; count < items.length; count++) {
            var divContainer='<td class="c-two" style="background-image:url(' + items[count].pathFile + items[count].nameLogo + ');background-size: cover"> ' +
                '<div class="fdw-background"> <p class="fdw-port"> <a href="http://'+ window.location.hostname +'/'+
                'user/profileBand/' + items[count].userName + '">' +  items[count].bandName + '</a></p></div></td>';

            $(divContainer).hide().appendTo(row).fadeIn(1000);
            if(count == 1 || count%2 == 1){
                $(".artists").append(row);
                row = $('<tr></tr>');
            }
        }
        $(".artists").append(row);

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
    <div id="searchContainer" style="position: absolute; left: 50%; margin-left: -140px;">
        <table>
            <tbody id="box">
                <tr>
                    <td>
                        <input class="form-input music-input" type="text" size="50" maxlength="100" autocomplete="off" id="search" value="Enter a name or band..."/>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</header>
<div class="container">
    <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1">Songs</li>
        <li class="tab-link" data-tab="tab-2">Artists</li>
    </ul>
    <div id="tab-1" class="tab-content current">
    <select id="genreMusic" class="button" name="genreMusic">
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
    <select id="genreArtist" class="button" name="genreMusic">
        <option>Rock</option>
        <option>Classic</option>
        <option>Rap</option>
        <option>Pop</option>
        <option>Punk</option>
    </select>
        <table class="artists">
            <tbody>
                
            </tbody>
        </table>
    </div>
</div>

