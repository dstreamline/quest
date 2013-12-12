<?php ?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="//api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">

        setTimeout('getCores()',1000);

       function timeouter (parm){

           clearInterval( $('#intervalen').val());
           var timer = setInterval('getCores()', parm);
           $('#intervalen').val(timer);
           console.log (timer);
        }



//        setInterval('getCores()', 10000)


        function getCores() {

            $.ajax({
                type: 'POST',
                url: 'Metric/getcores',
                data: {hello: 1},
                success: function (data) {
                    var info = JSON.parse(data);
                    init(info);
                }
            });

        }


        function init(info) {


            $('#map').html('');


            var myMap = new ymaps.Map("map", {
                center: [<?php echo $model[0]->latitude?>, <?php echo $model[0]->longitude?>],
                zoom: 15,
                behaviors: ['default', 'scrollZoom']
            });


            for (var k in info) {
                var functionName = 'd' + Math.floor(Math.random() * 1000001);


                window[functionName] = new ymaps.Placemark([info[k].latitude, info[k].longitude], {

                    balloonContentHeader:k
                }, {
//                    preset: "twirl#yellowStretchyIcon",
//                    // Отключаем кнопку закрытия балуна.
//                    balloonCloseButton: true,
//                    // Балун будем открывать и закрывать кликом по иконке метки.
//                    hideIconOnBalloonOpen: true
                });
                console.log(info[k].latitude);
                console.log(info[k].longitude);
                console.log(window[functionName]);


                myMap.geoObjects.add(window[functionName]);

                //myMap.geoObjects.add(window[functionName]);
            }


            myMap.options.set('scrollZoomSpeed', 2.5);


        }
    </script>
</head>

<body>

<div class="row">
    <div id="map" style="height: 768px" class="col-xs-12 col-md-10"></div>
    <div class="col-md-2">


        <div class="btn-group"  data-toggle="buttons">
            <label onclick="timeouter(5000);" class="btn btn-primary  5-sek-option">
                <input type="radio" name="options" id="option1"> 5 sec
            </label>
            <label  onclick="timeouter(15000);" class="btn btn-primary">
                <input type="radio" name="options" id="option2"> 15sec
            </label>
            <label onclick="timeouter(60000);"  class="btn btn-primary">
                <input type="radio" name="options" id="option3"> 60sec
            </label>
            <label onclick="timeouter(120000);" class="btn btn-primary">
                <input type="radio" name="options" id="option3"> 2min
            </label>
        </div>



    </div>
</div>
<input type="hidden" id="intervalen" value="0">

</body>

</html>