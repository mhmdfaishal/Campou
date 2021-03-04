<?= $this->extend('layout/template');?>

<?= $this->section('contentcustomer');?>
<div class="content-admin">
    <table border="1" class="table-customer">
        <tr>
            <th>Foto</th>
            <th>Username</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php $count = 0;foreach ($customer as $row) : $count++?>
            <tr>
                <td><img src="assets/img_cust/<?= $row['foto'];?>" alt="profile-pic"></td>
                <td><?= $row['username_cust'];?></td>
                <td><?= $row['Email'];?></td>
                <td> 
                    <button><a href="/admin/editcustomer/<?php echo $row['username_cust']; ?>"><i class="fas fa-pencil-alt"></i> EDIT</a></button>
                    <button><a href="/admin/deletecustomer/<?php echo $row['username_cust']; ?>"><i class="fas fa-trash-alt"></i> DELETE</a></button>
                </td>
                <?php endforeach;if($count == 0){?>
                    <td colspan="9" style="width: 1520;">Tidak ada Customer</td>
                <?php };?>
            </tr>
        
    </table>
</div>
<?= $this->endSection();?>