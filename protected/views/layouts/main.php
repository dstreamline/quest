<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- blueprint CSS framework -->
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/screen.css" media="screen, projection" />-->
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/print.css" media="print" />-->
	<!--[if lt IE 8]>
	<!--<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />-->
	<![endif]-->

<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/main.css" />-->
<!--	<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/form.css" />-->

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="main-wraper" id="page">



    <?php
    echo CHtml::openTag('div', array('class' => 'bs-navbar-top-example'));
    $this->widget(
        'bootstrap.widgets.TbNavbar',
        array(
           'type' => null, // null or 'inverse'
            'brand' => 'EN Metric',

            'brandUrl' => '#',
           'collapse' => true, // requires bootstrap-responsive.css
            //'fixed' => false,
            'items' => array(
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Home', 'url' => '#', 'active' => true),
                        array('label' => 'Codes Generator', 'url' => '#'),
                    ),
                ),


            ),
        )
    );
    echo CHtml::closeTag('div');

//    echo CHtml::openTag('div', array('class' => 'bs-navbar-top-example'));
//    $this->widget(
//        'bootstrap.widgets.TbNavbar',
//        array(
//            'brand' => 'Title',
//            'brandOptions' => array('style' => 'width:auto;margin-left: 0px;'),
//            'fixed' => 'top',
//            'htmlOptions' => array('style' => 'position:absolute'),
//            'items' => array(
//                array(
//                    'class' => 'bootstrap.widgets.TbMenu',
//                    'items' => array(
//                        array('label' => 'Home', 'url' => '#', 'active' => true),
//                        array('label' => 'Link', 'url' => '#'),
//                        array('label' => 'Link', 'url' => '#'),
//                    )
//                )
//            )
//        )
//    );
//    echo CHtml::closeTag('div');

    ?>


    <!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
<!--		Copyright &copy; --><?php //echo date('Y'); ?><!-- by My Company.<br/>-->
<!--		All Rights Reserved.<br/>-->
<!--		--><?php //echo Yii::powered(); ?>
	</div>

</div><!-- page -->

</body>
</html>
