<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="shortcut icon" href="/assets/img/logo1.png">
        <title>Tambah Admin</title>
        <link rel="stylesheet" href="/assets/style/style_update.css">
    </head>
    <body>
        <header>
            <h1>Create Admin</h1>
        </header>
        <form method="post" action="/createadmin" enctype="multipart/form-data">
                <?php if(session()->get('success')) : ?>
                    <h4 role="alert" style="margin-left:40%;width:20%;text-align:center;padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(8, 124, 37);background-color: rgb(188, 255, 167);color: rgb(8, 124, 37);">
                        <?= session()->get('success')?>
                    </h4>
                <?php endif;?>
                
                <?php if(session()->get('failed')) : ?>
                    <h4 role="alert" style="margin-left:40%;width:20%;text-align:center;padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(230, 59, 59);background-color: rgb(247, 170, 170);color: rgb(230, 59, 59);">
                        <?= session()->get('failed')?>
                    </h4>
                <?php endif;?>
            <table>
                <tr> 
                    <td><label for="id">ID Admin</label></td>
                    <td>
                        <input type="text" name="idpenyedia" class="input-data" required>
                    </td>
                </tr>
                <tr>
                    <td><label for="nama">Nama</label></td>
                    <td><input type="text" name="namapenyedia" class="input-data" required></td>
                </tr>
                <tr>
                    <td><label for="email">Email</label></td>
                    <td><input type="text" name="email" class="input-data" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password" class="input-data" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>
                    <td><input type="password" name="password_confirm" class="input-data" required></td>
                </tr>
                <tr>
                    <td><label for="nomor_telepon">Nomor_Telepon</label></td>
                    <td><input type="text" name="nomor_telepon" class="input-data" ></td>
                </tr>
                <tr>
                    <td><label for="foto">Foto Profile</label></td>
                    <td><input class="btn-pic" id="foto" name="foto" type="file" onchange="$('#foto').html($(this).val());" required></td>
                </tr>
                
                <tr>
                    <td colspan="2">
                        <button class="btn-update" style="margin-left: 100px;"><i class="far fa-save"></i> SIMPAN</button>
                    </td>
                </tr>
            </table>
            
        </form>
        <button class="btn-back" style="margin-left: 400px;"><a href="/admin" style="text-decoration: none; color: black;"><i class="fas fa-chevron-left"></i> KEMBALI</a></button>
    </body>

</html>