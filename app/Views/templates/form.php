<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>FORM PEMESANAN</title>
        <link rel="shortcut icon" href="/assets/img/logo1.png">
        <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/glacial-indifference" type="text/css"/> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="/assets/style/form.css">
    </head>
    <body>
       
        <div class="card">
            <h3><b>FORM PEMESANAN</b></h3>
            <?php if(session()->get('gagal')) : ?>
                <h4 role="alert">
                    <?= session()->get('gagal')?>
                </h4>
            <?php endif;?>
            <form action="/penyewaan/save" method="post">
                <table>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" id="usernamePemesan" name="usernamePemesan" class="usernamePemesan" value="<?php echo  $customer->username_cust; ?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td> : </td>
                        <td><input type="text" id="namaPemesan" name="namaPemesan" class="namaPemesan" required ></td>
                    </tr>
                    <tr>
                        <td>Lapangan</td>
                        <td> : </td>
                        <td><input type="text" name="namaLapangan" class="namaLapangan" value="<?= $lapangan->Nama_Lapangan?> <?= $lapangan->Nomor_Lapangan?>" readonly>
                        <input type="hidden" name="IdLapangan" value="<?php echo  $lapangan->IdLapangan; ?>" >
                        <input type="hidden" id="harga" name="harga" value="<?= $tarif->harga; ?>"></td>
                    </tr>
                    <tr>
                        <td>No. HP</td>
                        <td> : </td>
                        <td><input type="text" name="noHP" class="noHP" required ></td>
                    </tr>
                    <tr>
                        <td>Tanggal Main</td>
                        <td> : </td>
                        <td><input type="date"  name="tanggal_main"  id="tanggal_main" value="" required onchange="cektanggal(this.value)"></td>
                    </tr>
                    <tr>
                        <td>Jam Main</td>
                        <td> : </td>
                        <td><select name="jam_main" id="jam_main" required onchange="cekjam(this.value)">
                            <option value="null" disabled>Pilih Jam</option>
                            <option value="13">13.00</option>
                            <option value="14">14.00</option>
                            <option value="15">15.00</option>
                            <option value="16">16.00</option>
                            <option value="17">17.00</option>
                            <option value="18">18.00</option>
                            <option value="19">19.00</option>
                            <option value="20">20.00</option>
                            <option value="21">21.00</option>
                            <option value="22">22.00</option>
                        </select></td>
                    </tr>
                    <tr>
                        <td>Durasi</td>
                        <td> : </td>
                        <td><select name="durasi" id="durasi" onchange="totalharga(this.value)" required>
                            <option value="0" disabled>Pilih Durasi</option>
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                            <option value="4">4 Jam</option>
                            <option value="5">5 Jam</option>
                            <option value="6">6 Jam</option>
                            <option value="7">7 Jam</option>
                            <option value="8">8 Jam</option>
                            <option value="9">9 Jam</option>
                            <option value="10">10 Jam</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td> : </td>
                        <td><input type="text" class="status" name="status" id="status" disabled></td>
                    </tr>
                    <tr>
                        <td>Total Harga</td>
                        <td> : </td>
                        <td><input type="text" id="total_harga" name="total_harga" class="total_harga" value="" disabled></td>
                    </tr>
                </table>
                <button class="button" name="submit"><i class="fas fa-book"></i> Book</button>
            </form>
            <a href="/dashboard"><button class="button back" name="back"><i class="fas fa-arrow-left"></i> Back</button></a>
        </div>
    </body>
    <script>
        var harga = document.getElementById("harga").value;
        function totalharga(val){
            var totalharga =  val*harga;
            document.getElementById("total_harga").value = totalharga;
        }
        function cektanggal(val){
            var today = new Date();
            today = Date.parse(today.getMonth()+1+'/'+today.getDate()+'/'+today.getFullYear());
            var selDate = Date.parse(val);

            if(selDate < today) {
                var salahhari = "mm/dd/yyyy";
                document.getElementById("tanggal_main").value = salahhari;
            }
        }
        function cekjam(val){
            var today = new Date();
            var jamsekarang = today.getHours();
            var menitdipilih = 00;
            var menitsekarang = today.getMinutes();
            today = Date.parse(today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate());
            var tanggaldipilih = document.getElementById("tanggal_main").value;
            var selDate = Date.parse(tanggaldipilih);
            var durasidipilih = document.getElementById("durasi").value;
            var jamselesai = val + durasidipilih;

            if(selDate == today){
                if(val <= jamsekarang && menitdipilih <= menitsekarang){
                    var salahjam = "Jam yang anda pilih tidak valid!";
                    document.getElementById("jam_main").value = "null";
                    document.getElementById("status").value = salahjam; 
                }
                else{
                    var benarjam = "Jam yang anda pilih valid!";
                    document.getElementById("status").value = benarjam;
                }
            }else{
                var benarjam = "Jam yang anda pilih valid!";
                document.getElementById("status").value = benarjam;  
            }
        }
        
    </script>
</html>