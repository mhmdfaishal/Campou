<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/glacial-indifference" type="text/css" />
    <link rel="stylesheet" href="/assets/style/editprofile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/logo1.png">
    <title>CAMPOU</title>
</head>
<body>
    <header>
        <nav class="navigasi">
            <a href="/dashboard"><img src="/assets/img/logo1.png" alt="Logo Campou"></a>
            <ul>
                <li>
                    <p class="btn-profile-pic" onclick="myFunction()"><i class="fas fa-chevron-down"></i><img src="/assets/img_cust/<?= $customer->foto; ?>" alt="profile-pic" class="profile-pic"></p>
                    <ul class="dropdown-content" id="dropdown-menu">
                        <li><a href="/editprofile/<?= $customer->username_cust; ?>"><i class="fas fa-user"></i> Edit Profile</a></li>
                        <li><a href="/daftarpenyewaan"><i class="fas fa-info-circle"></i> Daftar Pemesanan</a></li>
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
        <h1 style="margin-left: 3%;">EDIT PROFILE</h1>
        <a href=""><img src="/assets/img_cust/<?= $customer->foto; ?>" alt="profilepic"></a>
        <form method="post" action="/saveprofile" enctype="multipart/form-data">
            <table>
                <tr> 
                    <td><label for="username_cust">Username</label></td>
                    <td>
                        <input type="text" name="username_cust" class="input-data" value="<?= $customer->username_cust; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="text" name="email" class="input-data" value="<?= $customer->Email; ?>" placeholder="Your Email"></td>
                </tr>
                <tr>
                    <td><label for="foto">New Foto</label></td>
                    
                    <td>
                        <input type="hidden" name="fotolama" class="input-data" value="<?= $customer->foto;?>">
                        <input type="file" name="foto" class="input-data" >
                    </td>
                </tr>
                <tr>
                    <td colspan="10">
                        <input type="submit" value="SIMPAN" class="btn-update">
                    </td>
                </tr>
               
            </table>
        </form>
        <a href="/changepassword/<?= $customer->username_cust;?>"><button class="btn-change">Change Password</button></a>
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