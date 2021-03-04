<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="/assets/style/style_update.css">
        <link rel="shortcut icon" href="/assets/img/logo1.png">
        <title>EDIT ADMIN</title>
    </head>
    <body>
        <header>
            <h1>UPDATE ADMIN</h1>
        </header>
        <form method="post" action="/updateadmin" enctype="multipart/form-data">
            <table>
                <tr> 
                    <td><label for="nama">Nama Admin</label></td>
                    <td>
                        <input type="hidden" name="idpenyedia" class="input-data" value="<?= $penyedia->IdPenyedia; ?>" readonly>
                        <input type="text" name="namapenyedia" class="input-data" value="<?= $penyedia->Nama_Penyedia; ?>" >
                    </td>
                </tr>
                <tr>
                    <td><label for="nama">Email</label></td>
                    <td><input type="text" name="email" class="input-data" value="<?= $penyedia->email; ?>"></td>
                </tr>
                <tr>
                    <td><label for="nama">Nomor Telepon</label></td>
                    <td><input type="text" name="nomor_telepon" class="input-data" value="<?= $penyedia->Nomor_Telepon; ?>"></td>
                </tr>
                <tr>
                    <td><label for="foto">New Foto</label></td>
                    <td>
                    <input type="hidden" name="fotolama" class="input-data" value="<?= $penyedia->foto;?>">
                    <input type="file" name="foto" class="input-data" >
                    
                </td>
                <tr>
                    <td colspan="10">
                        <button class="btn-update" style="margin-left: 100px;"><i class="far fa-save"></i> SIMPAN</button>
                    </td>
                </tr>
               
            </table>
            
        </form>
        <button class="btn-back" style="margin-left: 400px;"><a href="/admin" style="text-decoration: none; color: black;"><i class="fas fa-chevron-left"></i> KEMBALI</a></button>
    </body>

</html>