<?php
/* @var $this FormController */
/* @var $model GeoForm */

$this->breadcrumbs = array(
    'Geo Forms' => array('index'),
    'Create',
);

$this->menu = array(
    array('label' => 'List GeoForm', 'url' => array('index')),
    array('label' => 'Manage GeoForm', 'url' => array('admin')),
);
?>

<h1>Create GeoForm</h1>

<?php $this->renderPartial('_form', array('model' => $model)); ?>
<?php

?>

<div id="workField">
    <form class="input-append">

        <div class="span6 text-text" >
            <label class="control-label" for="field1" style="text-align: center"><h5> Фрагменты кода</h5></label>
            <?php $this->renderPartial('input3', array('model' => $model)); ?>
            <div id="clickDummy"></div>
        </div>
        <div class="span6 text-text">

            <label class="control-label" style="text-align: center; " for="field2"><h5>Параметры генерации</h5></label>
            <?php $this->renderPartial('input4', array('model' => $model)); ?>
            <?php $this->renderPartial('input7', array('model' => $model)); ?>
            <?php $this->renderPartial('input8', array('model' => $model)); ?>
            </div>
        </div>
    </form>
</div>

<div style="text-align: center" class="span12">
    <button class="btn btn-danger"> GENERATE</button>
</div>




