<?php
/* @var $this PegawaiController */
/* @var $dataProvider CActiveDataProvider */


$this->menu=array(
	array('label'=>'Create Pegawai', 'url'=>array('create')),
	array('label'=>'Manage Pegawai', 'url'=>array('admin')),
	array('label'=>'Tampilkan Pegawai', 'url'=>array('tampilkan')),
);
?>

<h1>Pegawai</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
