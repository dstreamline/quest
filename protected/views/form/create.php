<?php
/* @var $this FormController */
/* @var $model GeoForm */

$this->breadcrumbs=array(
	'Geo Forms'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GeoForm', 'url'=>array('index')),
	array('label'=>'Manage GeoForm', 'url'=>array('admin')),
);
?>

<h1>Create GeoForm</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>