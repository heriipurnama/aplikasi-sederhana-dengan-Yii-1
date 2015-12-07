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
		<th width="200">NIP</th>
		<th width="300">NAMA</th>
	    <th width="30">ALAMAT</th>
		<th width="200">TANGGAL LAHIR</th>
		<th width="300">AGAMA</th>
	</tr>
	<?php
	    $no=0; 
			foreach ($model as $kota ) {
				# code...
				$no++;
				?>
				<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $kota['nip'];?></td>
					<td><?php echo $kota['nama'];?></td>
					<td><?php echo $kota['alamat'];?></td>
					<td><?php echo $kota['tanggal_lahir'];?></td>
					<td><?php echo $kota['agama'];?></td>
				</tr>
				<?php
			}
			?>
</table>