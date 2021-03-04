<?= $this->extend('layout/template');?>

<?= $this->section('contentlapangan');?>
<div class="content-admin">
<button  class="add-button"><a href="/admin/tambahlapangan"><i class="fas fa-plus"></i> TAMBAH</a></button><br>
    <table border="1" class="table-lapangan">
        <tr>
            <th>Foto</th>
            <th>ID Lapangan</th>
            <th>Nama Lapangan</th>
            <th>Kode Tarif</th>
            <th>Nomor Lapangan</th>
            <th>Deskripsi Lapangan</th>
            <th>Action</th>
        </tr>
        <?php foreach ($lapangan as $row) : ?>
            <tr>
                <td><img src="assets/img/<?= $row['foto'];?>" alt="profile-pic"></td>
                <td><?= $row['IdLapangan'];?></td>
                <td><?= $row['Nama_Lapangan'];?></td>
                <td><?= $row['kode_tarif'];?></td>
                <td><?= $row['Nomor_Lapangan'];?></td>
                <td style="font-size: 12px;"><?= $row['deskripsi'];?></td>
                <td> 
                    <button><a href="/admin/editlapangan/<?php echo $row['IdLapangan']; ?>"><i class="fas fa-pencil-alt"></i> EDIT</a></button>
                    <button><a href="/admin/deletelapangan/<?php echo $row['IdLapangan']; ?>"><i class="fas fa-trash-alt"></i> DELETE</a></button>
                </td>
            </tr>
            
            <?php endforeach;?>
    </table>
</div>
<?= $this->endSection();?>