<?php

class MetricController extends Controller
{

    public function actionIndex()
    {


        if(Yii::app()->request->isPostRequest)
        {
            $geo=GeoOptions::getParm('metric_core');
            $geo->parameter=Yii::app()->request->getParam('cores', 0);
            $geo->update();
        }
        //$this->layout = false;
        $criteria = new CDbCriteria;
        $criteria->group = 'user_id';
        $criteria->order = 'time DESC';

        $geolocal = GeoUnique::model()->findAll($criteria);
        $this->render('index', array('model' => $geolocal));

    }

    public function actionAjaxbackend()
    {
        if (Yii::app()->request->isAjaxRequest) {


            $h_ua = str_replace('windows ce', '', strtolower($_SERVER['HTTP_USER_AGENT']));
            if (
                !$h_ua ||
                strpos($h_ua, 'windows') !== false
            ) {
                // it's computer - not show counter
            } else {


                $geoLog = new GeoLog();
                $geoLog->longitude = $_POST['longitude'];
                $geoLog->latitude = $_POST['latitude'];
                $geoLog->user_id = $_POST['user_id'];
                $geoLog->time = time();
                $geoLog->insert();

                $geoUser = GeoUnique::model()->findAll('user_id="' . $_POST['user_id'] . '"');
                if (isset($geoUser)) {
                    foreach ($geoUser as $userData) {
                        $userData->delete();
                    }
                }
                $geoUser = new GeoUnique();
                $geoUser->longitude = $_POST['longitude'];
                $geoUser->latitude = $_POST['latitude'];
                $geoUser->user_id = $_POST['user_id'];
                $geoUser->time = time();
                $geoUser->insert();
            }
        }

    }




    public function actionAjaxb()
    {



            $h_ua = str_replace('windows ce', '', strtolower($_SERVER['HTTP_USER_AGENT']));
            if (
                !$h_ua ||
                strpos($h_ua, 'windows') !== false
            ) {
                // it's computer - not show counter
            } else {


                $geoLog = new GeoLog();
                $geoLog->longitude = $_POST['lon'];
                $geoLog->latitude = $_POST['lat'];
                $geoLog->user_id = $_POST['imei'];
                $geoLog->time = time();
                $geoLog->insert();

                $geoUser = GeoUnique::model()->findAll('user_id="' . $_POST['imei'] . '"');
                if (isset($geoUser)) {
                    foreach ($geoUser as $userData) {
                        $userData->delete();
                    }
                }
                $geoUser = new GeoUnique();
                $geoUser->longitude = $_POST['lon'];
                $geoUser->latitude = $_POST['lat'];
                $geoUser->user_id = $_POST['trackid'];
                $geoUser->time = time();
                $geoUser->insert();
            }


    }



    public function actionGetcores()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $criteria = new CDbCriteria;
            $criteria->group = 'user_id';
            $criteria->order = 'time DESC';
            $geolocal = GeoUnique::model()->find($criteria);
            $geos['start']=array($geolocal->latitude,$geolocal->longitude );
            $geos['end']='';

            $geos['end']=(preg_match('/[а-я]/', GeoOptions::getParm('metric_core')->parameter))?'Харьков'. GeoOptions::getParm('metric_core')->parameter:GeoOptions::getParm('metric_core')->parameter;


            echo json_encode($geos, 1);
//            echo $geolocal->latitude.', '.$geolocal->longitude ;
//            if ($geolocal) {
//                foreach ($geolocal as $geo) {
//                    $geosp[$geo->user_id]['latitude'] = $geo->latitude;
//                    $geosp[$geo->user_id]['longitude'] = $geo->longitude;
//                }
//            }

        }
//        echo json_encode($geosp, 1);
    }

}