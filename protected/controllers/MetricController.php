<?php

class MetricController extends Controller
{

    public function actionIndex()
    {
        $this->layout =false;
        $criteria=new CDbCriteria;
        $criteria->group = 'user_id';
        $criteria->order = 'time DESC';

        $geolocal=GeoLocals::model()->findAll($criteria);
        $this->render('index',array('model'=>$geolocal) );

    }
	public function actionAjaxbackend()
	{
        if(Yii::app()->request->isAjaxRequest){
            $geoLocals=new GeoLocals();
            $geoLocals->longitude=$_POST['longitude'];
            $geoLocals->latitude=$_POST['latitude'];
            $geoLocals->user_id=$_POST['user_id'];
            $geoLocals->time=time();
            $geoLocals->insert();
        }
	}

}