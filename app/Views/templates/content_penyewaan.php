<?= $this->extend('layout/template');?>

<?= $this->section('contentpenyewaan');?>
<div class="content-admin">
    <table border="1">
        <tr>
            <th>Nomor Penyewaan</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Nomor Telepon</th>
            <th>Nama_Lapangan</th>
            <th>ID Lapangan</th>
            <th>Tanggal Main</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Total Harga</th>
            <th>Action</th>
        </tr>
        <?php $count = 0;foreach ($detail_penyewaan as $row) : $count++?>
            <tr>
                <td><?= $row['nomor_penyewaan'];?></td>
                <td><?= $row['username_cust'];?></td>
                <td><?= $row['Nama'];?></td>
                <td><?= $row['Nomor_Telepon'];?></td>
                <td><?= $row['Nama_Lapangan'];?></td>
                <td><?= $row['IdLapangan'];?></td>
                <td><?= $row['tgl_main'];?></td>
                <td><?= $row['jam_mulai'];?></td>
                <td><?= $row['jam_selesai'];?></td>
                <td><?= $row['total_harga'];?></td>
                <td> 
                    <button><a href="/admin/editpenyewaan/<?php echo $row['nomor_penyewaan']; ?>/<?php echo $row['IdLapangan']; ?>"><i class="fas fa-pencil-alt"></i> EDIT</a></button>
                    <button><a href="/admin/deletepenyewaan/<?php echo $row['nomor_penyewaan']; ?>"><i class="fas fa-trash-alt"></i> DELETE</a></button>
                </td>
                <?php endforeach;if($count == 0){?>
                    <td colspan="12" style="width: 1520;">Belum ada penyewaan lapangan</td>
                <?php };?>
            </tr>
    </table>
</div>
<?= $this->endSection();?>