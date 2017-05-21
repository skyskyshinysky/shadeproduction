<script>
    function callbackSearching(code)
    {
        $("#box").children().not(":first()").remove();

        querySearhing = $("#search").val();
        if(querySearhing.length >= 3) {
            boxContent = '';
            $.post("/main/searchBoxPeople", {searchString: querySearhing},function(data){
                if(data!='') {
                    boxContent = '';
                    items = JSON.parse(data);
                    items = $.map(items,function (val, bands) {
                        return val;
                    });
                //    updateBoxContent(items);
                    $("#box").append(boxContent);
                    $(".item").bind("click",itmclick);
                }
            });
        }
    }
    function isEmpty(value) {
        return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
    }
    function updatePeopleBox(items) {

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
                // строим и выводим каркас для 10 записей
                updatePeopleBox(items);
            });
        }
    }

    $(document).ready(function () {
        $("#search").on('keyup', callbackSearching);
        $("#search").on('focusout', callbackFocusout);
        $("#search").on('focusin', callbackFocusin);
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
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj
    asdlkfjahslkdfjhalksdfhlkasjdlkasjdhfklasdhfkajshfdkasjhfdlkasdf;lajflq;wekfjla;djfl;asjdfl;aksdjfl;asdjfl;asd
    asdfasdfasdfalsdkfja;sldfj;asldjfl;asjdf;lasjdf;laskjdf;lakjsdl;fjas;ldfjaslkdjf;laskjdfl;asjdf;lajsdlf;kjas;dlfkj

</div>
