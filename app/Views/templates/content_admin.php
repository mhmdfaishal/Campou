<?= $this->extend('layout/template');?>

<?= $this->section('contentadmin');?>
<div class="content-admin">
<button  class="add-button"><a href="/admin/tambahadmin"><i class="fas fa-plus"></i> TAMBAH</a></button><br>
    <table border="1" class="table-admin">
        <tr>
            <th>Foto</th>
            <th>ID Admin</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Nomor Telepon</th>
            <th>Action</th>
        </tr>
        <?php foreach ($admin as $row) : ?>
            <tr>
                <td><img src="/assets/img_admin/<?= $row['foto'];?>" alt="profile-pic"></td>
                <td><?= $row['IdPenyedia'];?></td>
                <td><?= $row['Nama_Penyedia'];?></td>
                <td><?= $row['email'];?></td>
                <td><?= $row['Nomor_Telepon'];?></td>
                <td> 
                    <button><a href="/admin/edit/<?php echo $row['IdPenyedia']; ?>"><i class="fas fa-pencil-alt"></i> EDIT</a></button>
                    <button><a href="/admin/delete/<?php echo $row['IdPenyedia']; ?>"><i class="fas fa-trash-alt"></i> DELETE</a></button>
                </td>
            </tr>
            
            <?php endforeach;?>
    </table>
</div>
<?= $this->endSection();?>