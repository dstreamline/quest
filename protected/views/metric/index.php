<script src="//api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

<script type="text/javascript">


    var myMap;
    var myRoute;
    var needCentred = true;
    var counter=0;
    var trafifcInterval=5;
    ymaps.ready(init);
    function init() {
        // Создание экземпляра карты и его привязка к контейнеру с
        // заданным id ("map").
        myMap = new ymaps.Map('map', {
            // При инициализации карты обязательно нужно указать
            // её центр и коэффициент масштабирования.
            center: [50.00, 36.25],
            zoom: 15,
            behaviors: ['default', 'scrollZoom']
        });
        myMap.controls.add(
            new ymaps.control.ZoomControl()
        );
        myMap.options.set('scrollZoomSpeed', 4.5);


        var trafficControl = new ymaps.control.TrafficControl();
        myMap.controls
            .add('typeSelector')
            // В конструкторе элемента управления можно задавать расширенные
            // параметры, например, тип карты в обзорной карте.
            .add(new ymaps.control.MiniMap({
                type: 'yandex#publicMap'
            }));


        myPlacemark = new ymaps.Placemark([50.00, 36.25], {
            iconContent: 'EN',
            hintContent: 'ЭКИПАЖ!'
        }, {
            // Опции.
            // Стандартная фиолетовая иконка.
            preset: 'twirl#violetIcon'
        });
        myMap.geoObjects.add(myPlacemark);


        ymaps.route(
            [50.00, 36.25],
            { mapStateAutoApply: false }
        ).then(function (route) {
                myMap.geoObjects.add(myRoute = route);
            });


    }

    setInterval('getCores()', 1000);

    function getCores() {

        $.ajax({
            type: 'POST',
            url: 'Metric/getcores',
            data: {hello: 1},
            success: function (data) {
                var info = JSON.parse(data);
                myPlacemark.geometry.setCoordinates(info['start']);
                if (needCentred) {
                    if (myMap.setCenter(info['start'])) {
                        needCentred = false;
                    }
                }

                if(counter==0){
                    myMap.geoObjects.remove(myRoute);
                    if (info['end'] != "") {
                        ymaps.route(
                            [info['start'], info['end']],
                            { mapStateAutoApply: false }
                        ).then(function (route) {

                                // добавляем маршрут на карту
                                myMap.geoObjects.add(myRoute = route);
                            });
                    }
                }
                counter++;
                if( counter>trafifcInterval){
                    counter=0;
                }
            }
        });
    }


</script>


<div class="row-fluid">
    <div id="map" class="col-xs-12 col-md-10"></div>
</div>
