<style type="text/css">
	table.dataGrid{
		border-collapse: collapse;
		border: 1px solid black;
		width: 100%;
		#font-size:8px; 
	}
	table.dataGrid td{
		border: 1px solid black;
		padding: 5px 5px 5px 5px;

	}
	table.dataGrid tr th{
		border: :1px solid black;
		padding: 5px 5px 5px 5px;
	}
</style>
<h2>DAFTAR KOTA/KABUPATEN</h2>
<table class="dataGrid">
	<tr>
		<th width="30">NO</th>
		<th width="200">KOTA</th>
		<th width="300">PROVINSI</th>
	</tr>
	<?php
	    $no=0; 
			foreach ($model as $kota ) {
				# code...
				$no++;
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $kota['nm_kota'];?></td>
					<td><?php echo $kota['provinsi'];?></td>
				</tr>
				<?php
			}
			?>
</table>