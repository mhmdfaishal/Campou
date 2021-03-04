<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta charset="utf-8">
        <title>ADMIN CAMPOU</title>
        <link rel="shortcut icon" href="/assets/img/logo1.png">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="/assets/style/adminhome.css">
    </head>
    <body>
        <input type="checkbox" id="btn-side">
        <header>
            <label for="btn-side">
                <i class="fa fa-stream" aria-hidden="true" id="sidebar_btn"></i>
            </label>
            <div class="left">
                <a href="/admin/homepage"><img src="/assets/img/logo1.png"/></a>
            </div>
            <div class="right">
                <a href="/logoutadmin" class="logout-btn">Logout <i class="fas fa-sign-out-alt"></i></a>  
            </div>
            
        </header>
        <div class="sidebar">
            <center>
                <img src="/assets/img_admin/<?= $penyedia->foto; ?>" class="profile_img" alt="">
                <b><h4>Hi Admin, <?= $penyedia->Nama_Penyedia; ?></h4></b>
            </center>
            <a href="/admin"><i class="fas fa-users-cog"></i><span>Daftar Admin</span></a>
            <a href="/daftarcustomer"><i class="fas fa-users"></i><span>Daftar Customer</span></a>
            <a href="/daftarlapangan"><i class="fas fa-clipboard-list"></i><span>Daftar Lapangan</span></a>
            <a href="/admin/homepage"><i class="fa fa-calendar-alt" aria-hidden="true"></i><span>Daftar Penyewaan</span></a>
        </div>
        <div class="content">
            <?= $this->renderSection('contentpenyewaan');?>
            <?= $this->renderSection('contentcustomer');?>
            <?= $this->renderSection('contentadmin');?>
            <?= $this->renderSection('contentlapangan');?>
        </div>
    </body>
</html>