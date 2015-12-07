<table class="dataGrid">
	<tr>
		<th width="30">NO</th>
		<th width="200">KOTA</th>
		<th width="300">PROVINSI</th>
	</tr>
	<?php 
			foreach ($model as $model1 ) {
				# code...
				?>
				<tr>
					<td><?php echo $model1['id']; ?></td>
					<td><?php echo $model1['nm_kota'];?></td>
					<td><?php echo $model1['provinsi'];?></td>
				</tr>
				<?php
			}
			?>
</table>