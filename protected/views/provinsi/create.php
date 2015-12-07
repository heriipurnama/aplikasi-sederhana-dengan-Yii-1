<?php
/* @var $this ProvinsiController */
/* @var $model Provinsi */

$this->breadcrumbs=array(
	'Provinsis'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Provinsi', 'url'=>array('index')),
	array('label'=>'Manage Provinsi', 'url'=>array('admin')),
);
?>

<h1>Create Provinsi</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>