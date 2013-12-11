<?php

class MetricController extends Controller
{

    public function actionIndex()
    {
        $this->layout =false;
        $criteria=new CDbCriteria;
        $criteria->group = 'user_id';
        $criteria->order = 'time DESC';

        $geolocal=GeoUnique::model()->findAll($criteria);
        $this->render('index',array('model'=>$geolocal) );

    }
	public function actionAjaxbackend()
	{
        if(Yii::app()->request->isAjaxRequest){

            $geoLog=new GeoLog();
            $geoLog->longitude=$_POST['longitude'];
            $geoLog->latitude=$_POST['latitude'];
            $geoLog->user_id=$_POST['user_id'];
            $geoLog->time=time();
            $geoLog->insert();

            $geoUser=GeoUnique::model()->find ('user_id="'.$_POST['user_id'].'"');
            if(isset($geoUser)){
                $geoUser->delete();
            }
            $geoUser=new GeoUnique();
            $geoUser->longitude=$_POST['longitude'];
            $geoUser->latitude=$_POST['latitude'];
            $geoUser->user_id=$_POST['user_id'];
            $geoUser->time=time();
            $geoUser->insert();
        }


	}

}