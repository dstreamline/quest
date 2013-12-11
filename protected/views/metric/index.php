<?php foreach ($model as $data) {

}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Примеры. Балун и хинт</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script src="//api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
    <script src="http://yandex.st/jquery/1.6.4/jquery.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        ymaps.ready(init);

        function init() {
            var myMap = new ymaps.Map("map", {
                    center: [<?php echo $model[0]->latitude?>, <?php echo $model[0]->longitude?>],
                    zoom: 15,
                    behaviors:['default', 'scrollZoom']
                }),

                <?php $i=0; foreach ($model as $data){
                echo 'myPlacemark'.$i;?>= new ymaps.Placemark([<?php echo $data->latitude?>, <?php echo $data->longitude?>], {
                balloonContentHeader: "<?php echo $data->user_id?>",
            });

            myMap.options.set('scrollZoomSpeed', 0.5);
            myMap.geoObjects.add(<?php echo 'myPlacemark'.$i;?>);
                 <?php $i++;}?>






        }
    </script>
</head>

<body>
<div id="map" style="width:1024px; height:800px"></div>
</body>

</html>