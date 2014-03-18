    <script src="//api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">


        var myMap;
        ymaps.ready(init);
        function init () {
            // Создание экземпляра карты и его привязка к контейнеру с
            // заданным id ("map").
            myMap = new ymaps.Map('map', {
                // При инициализации карты обязательно нужно указать
                // её центр и коэффициент масштабирования.
                center:[50.00, 36.25],
                zoom:15,
                behaviors:['default', 'scrollZoom']
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

        }

        setInterval('getCores()', 1000);
         function getCores() {

            $.ajax({
                type: 'POST',
                url: 'Metric/getcores',
                data: {hello: 1},
                success: function (data) {
                    var info = JSON.parse(data);
                   myPlacemark.geometry.setCoordinates(info);
                }
            });
        }

    </script>




<div class="row-fluid">
    <div id="map" class="col-xs-12 col-md-10"></div>
</div>
