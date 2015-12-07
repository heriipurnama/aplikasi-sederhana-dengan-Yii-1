<?php
/* @var $this KotaController */
/* @var $data Kota */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('provinsi_id')); ?>:</b>
	<?php echo CHtml::encode($data->provinsi_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nm_kota')); ?>:</b>
	<?php echo CHtml::encode($data->nm_kota); ?>
	<br />


</div>