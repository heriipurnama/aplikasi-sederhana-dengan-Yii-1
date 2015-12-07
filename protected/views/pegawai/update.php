<?php
/* @var $this PegawaiController */
/* @var $model Pegawai */

$this->breadcrumbs=array(
	'Pegawais'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Pegawai', 'url'=>array('index')),
	array('label'=>'Create Pegawai', 'url'=>array('create')),
	array('label'=>'View Pegawai', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Pegawai', 'url'=>array('admin')),
);
?>

<h1>Update Pegawai <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>