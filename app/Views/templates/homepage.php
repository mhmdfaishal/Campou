<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css2?family=Karla&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/glacial-indifference" type="text/css" />
    <link rel="stylesheet" href="assets/style/style.css">
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
                        <li><a href="/daftarpenyewaan"><i class="fas fa-info-circle"></i> Daftar Pemesanan</a></li>
                        <li><a href="logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
                <li>
                    <p>hi,<br><?= $customer->username_cust; ?></p>
                </li>
                <li class="btnNav"><a href="#about-us"><i class="fas fa-address-card"></i> Tentang Kami</a></li>
                <li class="btnNav"><a href="#lapangan"><i class="fas fa-th-list"></i> Lapangan</a></li>
                <li class="btnNav"><a href="#"><i class="fas fa-home"></i> Home</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div id="content">
            <article id="main-definition" class="d-flex">
                <img src="assets/img/logo1.png" alt="Logo campou" class="flex-grow">
                <h2 class="flex-grow"><i>Campou</i> adalah platform berbasis website yang bertujuan untuk memudahkan proses booking lapangan dalam suatu gor tertentu</h2>
            </article>

            <article id="main-field">
                <h1 id="lapangan" class="align-text-center">Daftar Lapangan</h1>
                <?php foreach ($lapangan as $row) : ?>
                <div class="d-flex flex-direction-column">
                    <div class="card flex-grow margin-left-right-auto ">
                        <h4 class="field-title align-text-center margin-top-0"><?= $row['Nama_Lapangan'] . " " . $row['Nomor_Lapangan'];?></h4>
                        <div class="d-flex">
                            <img src="assets/img/<?= $row['foto'];; ?>" alt="<?= $row['Nama_Lapangan'];; ?>" class="featured-image-50 flex-grow " >
                            <div class="flex-grow">
                                <h5 class="desc-field align-text-justify">
                                    Deskripsi : <br>
                                    <?= $row['deskripsi'];; ?>
                                </h5>
                                <a href="penyewaan/<?= $customer->username_cust; ?>/<?= $row['IdLapangan'];; ?>" class="btnBooking"><i class="fas fa-book"></i> Book Now</a>
                                <a href="/daftarpenyewaancust/<?= $row['IdLapangan']; ?>" class="btnJadwal"><i class="fas fa-calendar-alt"></i> Cek Jadwal</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach;?>
            </article>
        </div>
        <aside>
            <article>
                <h1 id="about-us" class="align-text-center margin-top-0">Tentang Kami</h1>
                <div class="d-flex flex-direction-row">
                    <div class="card flex-grow margin-left-right-25 margin-top-bottom-2">
                        <h4 class="align-text-center"></h4>
                        <div class="d-flex flex-direction-column object-position-center">
                            <img src="assets/img_admin/16.jpg" alt="Faisal" class="featured-image-25 fle-grow">
                            <h5 class="name-title flex-grow margin-top-bottom-2">Faishal</h5>
                            <h6 class="name-job align-text-center margin-top-bottom-2">Backend Web Developer</h6>
                        </div>
                    </div>
                    <div class="card flex-grow margin-left-right-25 margin-top-bottom-2">
                        <h4 class="align-text-center"></h4>
                        <div class="d-flex flex-direction-column object-position-center">
                            <img src="assets/img_admin/20.jpg" alt="Joe" class="featured-image-25 fle-grow">
                            <h5 class="name-title flex-grow margin-top-bottom-2">Valent Ino</h5>
                            <h6 class="name-job align-text-center margin-top-bottom-2">Frontend Web Developer</h6>
                        </div>
                    </div>
                    <div class="card flex-grow margin-left-right-25 margin-top-bottom-2">
                        <h4 class="align-text-center"></h4>
                        <div class="d-flex flex-direction-column object-position-center">
                            <img src="assets/img_admin/44.jpg" alt="Alam" class="featured-image-25 fle-grow">
                            <h5 class="name-title flex-grow margin-top-bottom-2">Alam</h5>
                            <h6 class="name-job align-text-center margin-top-bottom-2">Fullstack Web Developer</h6>
                        </div>
                    </div>
                </div>
            </article>
        </aside>
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