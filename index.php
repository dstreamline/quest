<script src="http://code.jquery.com/jquery.min.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
    $(document).ready(function () {
        $('.nums').keypress(function (e) {
            if (!(e.which == 8 || e.which == 44 || e.which == 45 || e.which == 46 || (e.which > 47 && e.which < 58))) return false;
        });
    });
</script>
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
<html>
<head>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<div>
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
<div class="pb-10">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        <p>
            <select name="xType">
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
            <input maxlength="6" size="6" name="xMins" value='<?= $xMins ?>' class="nums"/> N 49/50.~~~~
        <p>
            <select name="yType">
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
            <input maxlength="6" size="6" value='<?= $yMins ?>' name="yMins" class="nums"/> E 36.~~~~~~
        <p>
            <input type="submit" value="Locate"/>

        <p>
            <input type="checkbox" name="mobile" <?php if ("on" == $mobile) {
                echo "checked";
            } ?> > wikimapia mobile version

        <p>
            <input type="checkbox" name="showMap" <?php if ("on" == $showMap) {
                echo "checked";
            } ?> > show map picture

        <p>
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
                if ("on" == $mobile) {
                    echo "<a href=http://wikimapia.org/m/#lang=en&lat=" . $xCoor . "&lon=" . $yCoor . "&z=18&m=m target=\"_blank\"> <img src=\"http://upload.wikimedia.org/wikipedia/commons/e/ed/WikimapiaLogo.PNG\" alt=Find by Wikimapia\" width=\"30\" height=\"30\"> </a><br>";
                } else {
                    echo "<a href=http://wikimapia.org/#lang=en&lat=" . $xCoor . "&lon=" . $yCoor . "&z=18&m=m target=\"_blank\"> <img src=\"http://upload.wikimedia.org/wikipedia/commons/e/ed/WikimapiaLogo.PNG\" alt=Find by Wikimapia\" width=\"30\" height=\"30\"> </a><br>";
                }
                if ("on" == $showMap) {
                    echo "<img src=\"http://static-maps.yandex.ru/1.x/?ll=" . $yCoor . "," . $xCoor . "&spn=0.012657,0.00189&pt=" . $yCoor . "," . $xCoor . ",pm2ntl&l=map\">";
                }
            }
            ?>
    </form>
    </div>
    <?php
    ?>


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
    <a href="index.php">Reset</a>

    <p>
        v 1.0
</div>
</body>
</html>