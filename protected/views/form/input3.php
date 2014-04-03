<div class="inp3"><div id="clickDummy"></div>
    <div id="col1" class="outer-box">
        <div id="field1_1" class="inner-box">
            <div>
                <input id="inp1_1_1" type="text" class="input-mini input-box"></div>
            <div>
                <button style="margin-top: 10px; margin-bottom: 10px" id="add1_1" type="button"
                        class="add-inp btn btn-primary button-width">+
                </button>
                <button style="margin-top: 10px; margin-bottom: 10px" id="rem1_1" type="button"
                        class="rem-inp btn btn-danger button-width">-
                </button>
            </div>
        </div>

        <div>
            <button id="addfie_1" type="button" class="btn btn-primary button-width add-fie"
                    style="margin-top: 10px; margin-bottom: 10px">+
            </button>
            <button id="remfie_1" type="button" class="btn btn-danger button-width rem-fie"
                    style="margin-top: 10px; margin-bottom: 10px">-
            </button>
        </div>
    </div>
    <div id="coladd" class="outer-box">
        <div class=" inner-box">
            <div>
                <button id="addcol" type="button" class="btn btn-primary button-width add-col">+ колонка</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var colVal = 1;
    var inputStatus = [
        [1]
    ];
    console.log(inputStatus);
    /*    Добавление колонок*/
    $(".add-col").click(function (e) {
        e.preventDefault();
        colVal++;
        var newDiv = '<div id="coladd" class="outer-box"> <div class=" inner-box"><div><button id="addcol" type="button" class="btn btn-primary button-width add-col">+ колонка</button></div></div></div>';
        $("#coladd").before(newDiv);
    });
    /*    Добавление интпутов*/
    $('body').on('click','.add-inp', function (e) {
        e.preventDefault();
        var fieldNum = this.id.charAt(this.id.length - 1);
        var colNum = this.id.charAt(this.id.length - 3);
        inputStatus[colNum - 1][fieldNum - 1]++;
        var newInp = '<div><input id="inp' + colNum + '_' + fieldNum + '_' + inputStatus[(colVal - 1)].length + '" type="text" class="input-mini input-box"></div>';
        $(this).before(newInp);
        console.log(colNum, fieldNum, inputStatus[0]);
    });
    /*    Удаление интпутов*/
    $('body').on('click','.rem-inp', function (e) {
        e.preventDefault();
        var fieldNum = this.id.charAt(this.id.length - 1);
        var colNum = this.id.charAt(this.id.length - 3);
        var delInp = '#inp' + colNum + '_' + fieldNum + '_' + inputStatus[(colVal - 1)].length;
        if (inputStatus[colNum - 1][fieldNum - 1] > 0) {
            inputStatus[colNum - 1][fieldNum - 1]--;
            $(delInp).remove();
            console.log(fieldNum,colNum);
            console.log(delInp);
        }
    });
    /*    Добавление полей*/
    $('body').on('click','.add-fie', function (e) {
        e.preventDefault();
        var colNum = this.id.charAt(this.id.length - 1);
        var fieldNum = (inputStatus[colNum-1].length + 1);
        inputStatus[(colNum - 1)][((inputStatus[(colNum - 1)].length))] = 1;
        console.log(inputStatus[0]);
        var newFie = '<div id="field' + colVal + '_' + fieldNum + '" class="inner-box"><div><input id="inp'+ colNum + '_' + fieldNum + '_1" type="text" class="input-mini input-box"></div><div><button style="margin-top: 10px; margin-bottom: 10px" id="add' + colNum +'_' +fieldNum +'" type="button" class="add-inp btn btn-primary button-width">+</button> <button style="margin-top: 10px; margin-bottom: 10px" id="rem' + colNum +'_' +fieldNum +'" type="button" class="rem-inp btn btn-danger button-width">-</button></div></div>';
        $(this).before(newFie);
    });
    /*    Удаление полей*/
    $('body').on('click','.rem-fie', function (e) {
        e.preventDefault();
        var colNum = this.id.charAt(this.id.length - 1);
        var fieldNum = (inputStatus[colNum-1].length + 1);
        delete inputStatus[(colNum - 1)][((inputStatus[(colNum - 1)].length) - 1)];
        var delFie = '#field' + colNum +'_' + fieldNum;
        $(delFie).remove()
    });
</script>