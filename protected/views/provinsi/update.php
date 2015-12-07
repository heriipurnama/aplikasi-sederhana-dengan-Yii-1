<?php
/* @var $this ProvinsiController */
/* @var $model Provinsi */

$this->breadcrumbs=array(
	'Provinsis'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Provinsi', 'url'=>array('index')),
	array('label'=>'Create Provinsi', 'url'=>array('create')),
	array('label'=>'View Provinsi', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Provinsi', 'url'=>array('admin')),
);
?>

<h1>Update Provinsi <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>