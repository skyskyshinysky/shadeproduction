<script>
    var querySearhing;

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
        console.log(items);
        for(var count = 0; count < items.length; count++) {
            var row = $('<tr></tr>').attr({
                'song-index': count,
            });

            var song = {
                "artist": items[count].bandName,
                "name": items[count].nameMusic.replace(/[\d\.\.mp3]+/g,""),
                "url": items[count].pathFile + items[count].nameMusic
            };

            var playImgSrc = <?php echo '"http://' . $_SERVER['HTTP_HOST']  . '/images/player/play.png"'?>;
            var playCell = $('<td></td>');
            var personalPlay = $('<div></div>').addClass('player-image');
            personalPlay.on('click', function() {
                playTrack($(this).parent().parent().attr('song-index'));
            });
            personalPlay.hover(function() {
                var currentSrc = $(this).find('img').attr('src').slice(0, -4);
                $(this).find('img').attr('src', currentSrc + 'HoverBlack.png');
            }, function() {
                var currentSrc = $(this).find('img').attr('src').slice(0, -14);
                $(this).find('img').attr('src', currentSrc + '.png');
            });
            var playImg = $('<img>').addClass('profile-image').attr({
                src: playImgSrc
            });

            playImg.appendTo(personalPlay);
            personalPlay.appendTo(playCell);


            var songCell = $('<td></td>')
            var divContainer = '<h3>' + items[count].bandName + ' - ' + items[count].nameMusic.replace(/[\d\.\.mp3]+/g,"") +
                '</h3>'
            var hidden = $('<input>').attr({
                type: 'hidden'
            });
            hidden.val(JSON.stringify(song));
            songCell.append(divContainer);
            songCell.append(hidden);

            row.append(playCell);
            row.append(songCell);

            $('.songs').append(row);
        }
    }

    function playTrack(index){
        var jsonSong = $("tr[song-index='" + index + "']").find('input').val();
        var songObject = $.parseJSON(jsonSong);
        Amplitude.playNow(songObject);
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
            if(count%2 == 1) {
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
        if(type == "Songs") {
            var genre = $("#genreMusic").val();
        }else {
            var genre = $("#genreArtist").val();
        }
        if(isEmpty(type) == false && isEmpty(genreMusic) == false) {
            $.post('/user/getBlockData', 'type=' + JSON.stringify(type) +
                '&jenre=' + JSON.stringify(genre),function (data) {
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
    function initializePlayer() {
        $.get("/main/getSongs",function(data){
            if(data != undefined) {
                var songs = $.parseJSON(data);
                console.log(songs);
                Amplitude.init({ songs: songs, "volume": .35 });
                Amplitude.bindNewElements();

                for(var index = 0; index < songs.length; index++){

                }
            }
        });
    }
    $(document).ready(function () {
        $("#search").on('keyup', callbackSearching);
        $("#search").on('focusout', callbackFocusout);
        $("#search").on('focusin', callbackFocusin);
        $("ul.tabs li").on('click', callbackTabs);
        $("#genreMusic").on('change', initializeBlock);
        $("#genreArtist").on('change', initializeBlock);
        initializePlayer();
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
        <div id="amplitude-player">
            <span class="amplitude-play"></span>
        </div>
        <table class="songs">
            <tbody>
                
            </tbody>
        </table>
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

<div class="player">
    <div id="listPlayerWrapper" style="display: none;">
        <table>
            <tbody>
                <tr>
                    <td>
                        <a href="#" class="amplitude-play list-link" style="padding: 0px 15px">Play</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="amplitude-pause list-link" style="padding: 0px 15px">Pause</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="amplitude-stop list-link"  style="padding: 0px 15px">Stop</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div id="" class="player-wrapper">
        <div class="player-image amplitude-prev">
            <?php
                echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . '/images/player/prev.png" />';
            ?>
        </div>
        <div class="player-image amplitude-play">
            <?php
                echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . '/images/player/play.png" />';
            ?>
        </div>
        <div class="player-image amplitude-pause">
            <?php
                echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . '/images/player/pause.png" />';
            ?>
        </div>
        <div class="player-image amplitude-stop">
            <?php
                echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . '/images/player/stop.png" />';
            ?>
        </div>
        <div class="player-image amplitude-next">
            <?php
                echo '<img class="profile-image" src="http://' . $_SERVER['HTTP_HOST']  . '/images/player/next.png" />';
            ?>
        </div>
        <div class="slider">
            <div id="slider">
                <input class="bar amplitude-volume-slider" type="range" id="rangeinput" value="35" onchange="rangevalue.value=value" />
                <span class="highlight"></span>
                <output id="rangevalue">35</output>
            </div>
        </div>
        <div class="song-info">
            <span class="amplitude-current-time" amplitude-main-current-time="true"></span>
        </div>
        <div class="song-info">
            <span amplitude-song-info="artist" amplitude-main-song-info="true"></span>
            <span> - </span>
            <span amplitude-song-info="name" amplitude-main-song-info="true" class="song-name"></span>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.player-image').hover(function() {
        var currentSrc = $(this).find('img').attr('src').slice(0, -4);
        $(this).find('img').attr('src', currentSrc + 'Hover.png');
    }, function() {
        var currentSrc = $(this).find('img').attr('src').slice(0, -9);
        $(this).find('img').attr('src', currentSrc + '.png');
    });
</script>
