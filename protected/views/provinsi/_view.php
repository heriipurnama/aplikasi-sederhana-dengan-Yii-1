<?php
/* @var $this ProvinsiController */
/* @var $data Provinsi */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provinsi')); ?>:</b>
	<?php echo CHtml::encode($data->provinsi); ?>
	<br />


</div>