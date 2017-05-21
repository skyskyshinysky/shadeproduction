<link rel="stylesheet" href="/css/tabs.css" />

<script>
    var querySearhing;
    var boxContent = '';

    function updateBoxContent(items) {
        for (var count = 0; count < items.length; count++) {
            boxContent = boxContent + '<tr class="search-row"><td class="item" cat=/user/profile/' + items[count].userName + '>' +
                items[count].firstName + ' ' + items[count].lastName + '</td><tr>';
        }
    }
    function callbackSearching(code)
    {
        $("#box").children().not(":first()").remove();
        querySearhing = $("#search").val();
        console.log(querySearhing);
        if(querySearhing.length >= 3) {
            boxContent = '';
            $.post("/main/searchBoxPeople", {searchString: querySearhing},function(data){
                if(data!='') {
                    boxContent = '';
                    items = JSON.parse(data);
                    updateBoxContent(items);
                    $("#box").append(boxContent);
                    $(".item").bind("click",itmclick);
                }
            });
        }
    }
    function itmclick(){
        window.location.pathname = $(this).attr("cat");
    }
    function isEmpty(value) {
        return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
    }
    function callbackFocusout() {
        if($(this).val()=='') $(this).val('Enter a first name or last name...');
    }
    function callbackFocusin() {
        if($(this).val()=='Enter a first name or last name...') $(this).val('');
    }
    function initializeBlock() {
        var genreMusic = $("#genreMusic").val();
        if(isEmpty(genreMusic) == false) {
            $.post('/user/getBlockDataPeople', 'genre=' + JSON.stringify(genreMusic),function (data)
            {
                //парсим JSON
                var items = JSON.parse(data);
                console.log(items);
                // строим и выводим каркас для 10 записей
                updatePeopleBox(items);
            });
        }
    }
    function updatePeopleBox(items) {
        $('.people').html('');

        var row = $('<tr></tr>');
        for(var count = 0; count < items.length; count++) {
            var divContainer='<td class="c-two" style="background-image:url(' + items[count].pathFile + items[count].nameLogo + ');background-size: cover"> ' +
                '<div class="fdw-background"> <p class="fdw-port"> <a href="http://'+ window.location.hostname +'/'+
                'user/profile/' + items[count].userName + '">' +  items[count].firstName + ' ' + items[count].lastName + '</a></p></div></td>';

            $(divContainer).hide().appendTo(row).fadeIn(1000);
            if(count%2 == 1) {
                $(".people").append(row);
                row = $('<tr></tr>');
            }
        }
        $(".people").append(row);
        $('.fdw-background').hover(
            function () {
                $(this).animate({opacity:'1'});
            },
            function () {
                $(this).animate({opacity:'0'});
            }
        );
    }
    $(document).ready(function () {
        $("#search").on('keyup', callbackSearching);
        $("#search").on('focusout', callbackFocusout);
        $("#search").on('focusin', callbackFocusin);
        $("#genreMusic").on('change', initializeBlock);
        initializeBlock();
    });
</script>

<header class="header-bg" style="background-image: url('/images/header-people-bg.jpg')">
    <div class="header-title">
        <h1>
            Connect with People
        </h1>
    </div>
    <div id="searchContainer" style="position: absolute; left: 50%; margin-left: -140px;">
        <table>
            <tbody id="box">
            <tr>
                <td>
                    <input class="form-input music-input" type="text" size="50" maxlength="100" autocomplete="off" id="search" value="Enter a first name or last name..."/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</header>
<div class="container" style="background: #ededed;">
    <select id="genreMusic" class="button" name="genreMusic">
        <option>Rock</option>
        <option>Classic</option>
        <option>Rap</option>
        <option>Pop</option>
        <option>Punk</option>
    </select>
    <table class="people">
        <tbody>

        </tbody>
    </table>
</div>
