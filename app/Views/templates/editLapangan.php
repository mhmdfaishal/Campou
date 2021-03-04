<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="/assets/style/style_update.css">
        <link rel="shortcut icon" href="/assets/img/logo1.png">
        <title>EDIT LAPANGAN</title>
    </head>
    <body>
        <header>
            <h1>UPDATE LAPANGAN</h1>
        </header>
        <form method="post" action="/updatelapangan" enctype="multipart/form-data">
            <table>
                <tr> 
                    <td><label for="username">Nama Lapangan</label></td>
                    <td>
                        <input type="text" name="namalapangan" class="input-data" value="<?= $lapangan->Nama_Lapangan; ?>">
                        <input type="hidden" name="idlapangan" class="input-data" value="<?= $lapangan->IdLapangan; ?>" >
                    </td>
                </tr>
                <tr>
                    <td><label for="nama">Tarif</label></td>
                    <td><select name="kode_tarif" id="kode_tarif">
                        <option value="default" disabled>Pilih Tarif</option>
                        <option value="trf1">Rp65000</option>
                        <option value="trf2">Rp125000</option>
                    </select></td>
                </tr>
                <tr> 
                    <td><label for="deskripsi">Deskripsi Lapangan</label></td>
                    <td>
                        <textarea name="deskripsi" class="input-data" cols="10" rows="5" style="text-align:justify;"><?= $lapangan->deskripsi; ?></textarea>                        
                    </td>
                </tr>
                <tr>
                    <td><label for="foto">Foto</label></td>
                    <td>
                        <input type="file" name="foto" class="input-data">
                        <input type="hidden" name="idlapangan" class="input-data" value="<?= $lapangan->IdLapangan; ?>" >
                        <input type="hidden" name="fotolama" class="input-data" value="<?= $lapangan->foto; ?>" >
                        <img src="/assets/img/<?= $lapangan->foto; ?>" alt="fotolapangan">
                    </td>
                </tr>               
                <tr>
                    <td colspan="10">
                        <button class="btn-update" style="margin-left: 100px;"><i class="far fa-save"></i> SIMPAN</button>
                    </td>
                </tr>
            </table>
            
        </form>
        <button class="btn-back" style="margin-left: 400px;"><a href="/daftarlapangan" style="text-decoration: none; color: black;"><i class="fas fa-chevron-left"></i> KEMBALI</a></button>
    </body>

</html>