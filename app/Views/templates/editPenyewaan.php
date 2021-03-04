<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="/assets/style/style_update.css">
        <link rel="shortcut icon" href="/assets/img/logo1.png">
        <title>EDIT PENYEWAAN</title>
    </head>
    <body>
        <header>
            <h1>UPDATE PENYEWAAN</h1>
        </header>
        <form method="post" action="/updatepenyewaan">
                <?php if(session()->get('gagal')) : ?>
                    <h4 role="alert" style="margin-left:40%;width:20%;text-align:center;padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(230, 59, 59);background-color: rgb(247, 170, 170);color: rgb(230, 59, 59);">
                        <?= session()->get('gagal')?>
                    </h4>
                <?php endif;?>
            <table>
                <tr> 
                    <td><label for="username">Username</label></td>
                    <td>
                        <input type="hidden" name="nomor_penyewaan" class="input-data" value="<?= $detail_penyewaan->nomor_penyewaan; ?>">
                        <input type="text" name="username" class="input-data" value="<?= $detail_penyewaan->username_cust; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="nama" class="input-data" value="<?= $detail_penyewaan->Nama; ?>"></td>
                </tr>
                <tr>
                    <td><label for="no_telp">Nomor Telepon</label></td>
                    <td><input type="text" name="nomor_telepon" class="input-data" value="<?= $detail_penyewaan->Nomor_Telepon; ?>"></td>
                </tr>
                <tr>
                    <td><label for="namalapangan">Nama Lapangan</label></td>
                    <td><input type="text" name="namalapangan" class="input-data" value="<?= $detail_penyewaan->Nama_Lapangan; ?>" readonly>
                    <td><input type="hidden" name="idlapangan" class="input-data" value="<?= $detail_penyewaan->IdLapangan; ?>" readonly>
                    <input type="hidden" name="harga" id="harga" class="input-data" value="<?= $tarif->harga; ?>"></td>
                </tr>
                <tr>
                    <td><label for="tgl_main">Tanggal Main</label></td>
                    <td><input type="date" name="tgl_main" class="input-data" value="<?= $detail_penyewaan->tgl_main; ?>"></td>
                </tr>
                <tr>
                    <td><label for="jam_mulai">Jam Mulai</label></td>
                    <td><select name="jam_main" required>
                            <option value="<?= $detail_penyewaan->tgl_main; ?>" disabled><?= $detail_penyewaan->tgl_main; ?></option>
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
                            <option value="23">23.00</option>
                        </select></td>
                </tr>
                <tr>
                    <td><label for="durasi">Durasi</label></td>
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
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="totalharga">Total Harga </label></td>
                    <td><input type="text" id="total_harga" name="total_harga" class="total_harga" value="" disabled></td>
                </tr>
                <tr>
                    <td colspan="10">
                        <button class="btn-update" style="margin-left: 100px;"><i class="far fa-save"></i> SIMPAN</button>
                    </td>
                </tr>

            </table>
            
        </form>
        <button class="btn-back" style="margin-left: 400px;"><a href="/admin/homepage" style="text-decoration: none; color: black;"><i class="fas fa-chevron-left"></i> KEMBALI</a></button>
    </body>
    <script>
        var harga = document.getElementById("harga").value;
        function totalharga(val){
            var totalharga =  val*harga;
            document.getElementById("total_harga").value = totalharga;
        }
    </script>
</html>