<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/glacial-indifference" type="text/css" />
    <link rel="stylesheet" href="assets/style/daftar_penyewaan.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/img/logo1.png">
    <title>CAMPOU</title>
</head>
<body>
    <header>
        <nav class="navigasi">
            <a href="/dashboard"><img src="assets/img/logo1.png" alt="Logo Campou"></a>
            <ul>
                <li>
                    <p class="btn-profile-pic" onclick="myFunction()"><i class="fas fa-chevron-down"></i><img src="assets/img_cust/<?= $customer->foto; ?>" alt="profile-pic" class="profile-pic"></p>
                    <ul class="dropdown-content" id="dropdown-menu">
                        <li><a href="/editprofile/<?= $customer->username_cust; ?>"><i class="fas fa-user"></i> Edit Profile</a></li>
                        <li><a href=""><i class="fas fa-info-circle"></i> Daftar Pemesanan</a></li>
                        <li><a href="/logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
                <li>
                    <p>hi,<br><?= $customer->username_cust; ?></p>
                </li>
                <li class="btnNav"><a href="/dashboard#about-us"><i class="fas fa-address-card"></i> Tentang Kami</a></li>
                <li class="btnNav"><a href="/dashboard#lapangan"><i class="fas fa-th-list"></i> Lapangan</a></li>
                <li class="btnNav"><a href="/dashboard#"><i class="fas fa-home"></i> Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
    <table>
        <tr>
            <th>Nomor Penyewaan</th>
            <th>Nama</th>
            <th>Nama Lapangan</th>
            <th>ID Lapangan</th>
            <th>Tanggal Main</th>
            <th>Jam Mulai</th>
            <th>Jam Selesai</th>
            <th>Total Harga</th>
            <th>Action</th>
        </tr>
        <?php $count = 0;foreach ($detail_penyewaan as $row) : 
            if($row['username_cust'] == $_SESSION['username']){
                ?>
            <tr>
                <td><?= $row['nomor_penyewaan'];?></td>
                <td><?= $row['Nama'];?></td>
                <td><?= $row['Nama_Lapangan'];?></td>
                <td><?= $row['IdLapangan'];?></td>
                <td><?= $row['tgl_main'];?></td>
                <td><?= $row['jam_mulai'];?></td>
                <td><?= $row['jam_selesai'];?></td>
                <td><?= $row['total_harga'];?></td>
                <td> 
                    <button><a href="/customer/deletepenyewaan/<?php echo $row['nomor_penyewaan']; ?>"><i class="fas fa-trash-alt"></i> DELETE</a></button>
                    
                </td>
            </tr>
            
            <?php $count++; }endforeach;if($count == 0){?>
            
            <tr>
                <td colspan="9" style="width: 1520;">Anda belum melakukan booking lapangan</td>
                
            </tr>
            <?php };?>
    </table>
    </main>
    <script>
        function myFunction() {
            document.getElementById("dropdown-menu").classList.toggle("show");
        }
        window.onclick = function(e) {
            if (!e.target.matches('.btn-profile-pic.')) {
                var dropdown_menu = document.getElementById("dropdown-menu");
                if (dropdown_menu.classList.contains('show')) {
                    dropdown_menu.classList.remove('show');
                }
            }
        }
    </script>
</body>

</html>