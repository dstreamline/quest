    <title>TD GeoHelper</title>

    <script>
        $(document).ready(function () {
            $('#windowTitleDialog').bind('show', function () {
                document.getElementById("xlInput").value = document.title;
            });
        });
        function closeDialog() {
            $('#windowTitleDialog').modal('hide');
        }
        ;
        function okClicked() {
            document.title = document.getElementById("xlInput").value;
            closeDialog();
        }
        ;
    </script>



    <!--    GEO LOCATION-->
    <script>
               setInterval('getGeoLocation()',5000);

        function getGeoLocation(){
            if(geo_position_js.init()){
                geo_position_js.getCurrentPosition(success_callback,error_callback,{enableHighAccuracy:true});

            }
            else{
                alert("Ошибка определения gps координат");
            }
        }

        function success_callback(p)
        {

            $.ajax({
                type: 'POST',
                url: 'Metric/ajaxbackend',
                data: {longitude:p.coords.longitude.toFixed(6), latitude:p.coords.latitude.toFixed(6),user_id:navigator.userAgent},

                success: function(data)
                {
                 }
                });
         }

        function error_callback(p)
        {
            alert('error='+p.message);
        }
    </script>
    <!--    GEO LOCATION-->







    <script type="text/javascript">
        $(document).ready(function () {
            $('.nums').keypress(function (e) {
                if (!(e.which == 8 || e.which == 44 || e.which == 45 || e.which == 46 || (e.which > 47 && e.which < 58))) return false;
            });
        });
    </script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="//api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(init);
        function init() {
            var myMap = new ymaps.Map("map", {
                    center: [55.76, 37.64],
                    zoom: 10
                }),
                myGeoObject = new ymaps.GeoObject({
                    geometry: {
                        type: "Point",
                        coordinates: [55.8, 37.8]
                    },
                    properties: {
                        iconContent: 'Метка',
                        balloonContent: 'Меня можно перемещать'
                    }
                }, {
                    preset: 'twirl#redStretchyIcon',
                    draggable: true
                }),
                myPlacemark1 = new ymaps.Placemark([55.8, 37.6], {
                    iconContent: '1',
                    balloonContent: 'Балун',
                    hintContent: 'Стандартный значок метки'
                }, {
                    preset: 'twirl#violetIcon'
                });
            myMap.geoObjects
                .add(myPlacemark1)
            myMap.controls
                .add('zoomControl', { left: 5, top: 5 })
                .add('typeSelector')
                .add('mapTools', { left: 35, top: 5 });
            var trafficControl = new ymaps.control.TrafficControl();
            myMap.controls
                .add(trafficControl)
                .add(new ymaps.control.MiniMap({
                    type: 'yandex#publicMap'
                }));
        }
    </script>
</head>
<?php
$xGrads = "49";
$xMins = "";
$yGrads = "36";
$yMins = "";
$xType = "N";
$yType = "E";
$mobile = "off";
$showMap = "off";
if (isset($_GET['xGrads'])) {
    $xGrads = $_GET['xGrads'] * 1;
}
if (isset($_GET['xMins'])) {
    $xMins = $_GET['xMins'] * 1;
}
if (isset($_GET['yGrads'])) {
    $yGrads = $_GET['yGrads'] * 1;
}
if (isset($_GET['yMins'])) {
    $yMins = $_GET['yMins'] * 1;
}
if ("S" == (@$_GET['xType'])) {
    $xType = "S";
}
if ("W" == (@$_GET['yType'])) {
    $yType = "W";
}
if (isset($_GET['mobile'])) {
    $mobile = strip_tags($_GET['mobile']);
}
if (isset($_GET['showMap'])) {
    $showMap = strip_tags($_GET['showMap']);
}
?>



<div class="show-for-small">КНОПКА </div>

<div class="topbar border-class">
    <div class="workpan border-class">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
            <div class="topelement">
                <select name="xType" class="enter1">
                    <option><?= $xType ?></option>
                    <?php
                    if ("S" == $xType) {
                        echo "<option>N</option>";
                    } else {
                        echo "<option>S</option>";
                    };
                    ?>
                </select>

                <input class="nums" maxlength="2" size="2" onFocus="doClear(this)" onBlur="doDefault(this)" name="xGrads"
                       value='<?= $xGrads ?>'/>.
                <input maxlength="6" size="6" name="xMins" value='<?= $xMins ?>' class="nums2"/>
            </div>
            <div class="topelement">
                <select name="yType" class="enter1">
                    <option><?= $yType ?></option>
                    <?php
                    if ("W" == $yType) {
                        echo "<option>E</option>";
                    } else {
                        echo "<option>W</option>";
                    };
                    ?>
                </select>
                <input class='nums' maxlength="2" size="2" value='<?= $yGrads ?>' name="yGrads" onFocus="doClear(this)"
                       onBlur="doDefault(this)" class="nums"/>.
                <input maxlength="6" size="6" value='<?= $yMins ?>' name="yMins" class="nums2"/>
                <input type="submit" value="GO!">
            </div>
            <div class="settingbtn">
                <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">Settings</a>
                <!-- Modal -->
                <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <!--       Окно настроек-->

                    <div class="modal-header">
                        <div class="make-switch switch-large">
                            <input type="checkbox" checked>

                            <button class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>
<div class="main-wrapper border-class">
    <script type="text/javascript">
        function doClear(theText) {
            if (theText.value == theText.defaultValue) {
                theText.value = ""
            }
        }
        function doDefault(theText) {
            if (theText.value == "") {
                theText.value = theText.defaultValue
            }
        }
    </script>
    <div>


        <p>
            <input type="checkbox" name="mobile" <?php if ("on" == $mobile) {
                echo "checked";
            } ?> > wikimapia mobile version

        <p>
            <input type="checkbox" name="showMap" <?php if ("on" == $showMap) {
                echo "checked";
            } ?> > show map picture

        <div class="both">
            <input type="text" id="adress" size="38">
            <?php
            if (isset($_GET['xGrads']) && isset($_GET['xMins']) && isset($_GET['yGrads']) && isset($_GET['xMins'])) {
                if ($xType == "S") {
                    $xGrads = -$xGrads;
                };
                $xCoor = "$xGrads.$xMins";
                if ($yType == "W") {
                    $yGrads = -$yGrads;
                };
                $yCoor = "$yGrads.$yMins";


//                if ("on" == $mobile) {
//                    echo "<a href=http://wikimapia.org/m/#lang=en&lat=" . $xCoor . "&lon=" . $yCoor . "&z=18&m=m target=\"_blank\"> <img src=\"http://upload.wikimedia.org/wikipedia/commons/e/ed/WikimapiaLogo.PNG\" alt=Find by Wikimapia\" width=\"30\" height=\"30\"> </a><br>";
//                } else {
//                    echo "<a href=http://wikimapia.org/#lang=en&lat=" . $xCoor . "&lon=" . $yCoor . "&z=18&m=m target=\"_blank\"> <img src=\"http://upload.wikimedia.org/wikipedia/commons/e/ed/WikimapiaLogo.PNG\" alt=Find by Wikimapia\" width=\"30\" height=\"30\"> </a><br>";
//                }

                if ("on" == $mobile):?>
                    <a href=http://wikimapia.org/m/#lang=en&lat=<?php echo $xCoor; ?>&lon=<?php echo $yCoor; ?>&z=18&m=m target="_blank"> <img src="http://upload.wikimedia.org/wikipedia/commons/e/ed/WikimapiaLogo.PNG" alt="Find by Wikimapia"
                                                                                                                                               width="30" height="30"> </a><br>
                <?php else: ?>
                    <div id="map" style="width:600px; height:600px"></div>
                    <a href=http://wikimapia.org/#lang=en&lat=<?php echo $xCoor; ?>&lon=<?php echo $yCoor; ?>&z=18&m=m target="_blank"> <img src="http://upload.wikimedia.org/wikipedia/commons/e/ed/WikimapiaLogo.PNG" alt="Find by Wikimapia"
                                                                                                                                             width="30"
                                                                                                                                             height="30"> </a><br>
                <?php endif;
                if ("on" == $showMap) {
                    echo "<img class =\"yandex-image-size\" src=\"http://static-maps.yandex.ru/1.x/?ll=" . $yCoor . "," . $xCoor . "&spn=0.012657,0.00189&pt=" . $yCoor . "," . $xCoor . ",pm2ntl&l=map\">";
                }
            }
            ?>
        </div>

    </div>
    <?php
    ?>
    <?php if (!isset($yCoor)){$yCoor=NULL;}if (!isset($xCoor)){$xCoor=NULL;}?>
    <script type="text/javascript">
        var Ecor = '<?php echo $yCoor;?>';
        var Ncor = '<?php echo $xCoor;?>';
        function go() {
            $.ajax({type: "GET",
                url: "http://geocode-maps.yandex.ru/1.x/?geocode=" + Ecor + "," + Ncor + "&format=json",
                dataType: "JSON", timeout: 30000, async: false,
                success: function (html) {
                    $('#adress').val(html.response.GeoObjectCollection.featureMember[0].GeoObject.name);
                }
            });
        }
        go();
    </script>
    <a href="/">Reset</a>
</div>
