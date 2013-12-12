<?php

class MetricController extends Controller
{

    public function actionIndex()
    {
        $this->layout = false;
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

    public function actionGetcores()
    {
        if (Yii::app()->request->isAjaxRequest) {
            $criteria = new CDbCriteria;
            $criteria->group = 'user_id';
            $criteria->order = 'time DESC';
            $geos = array();
            $geolocal = GeoUnique::model()->findAll($criteria);
            if ($geolocal) {
                foreach ($geolocal as $geo) {
                    $geosp[$geo->user_id]['latitude'] = $geo->latitude;
                    $geosp[$geo->user_id]['longitude'] = $geo->longitude;
                }
            }

        }
        echo json_encode($geosp, 1);
    }

}