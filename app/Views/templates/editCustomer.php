<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="/assets/style/style_update.css">
        <link rel="shortcut icon" href="/assets/img/logo1.png">
        <title>EDIT CUSTOMER</title>
    </head>
    <body>
        <header>
            <h1>UPDATE CUSTOMER</h1>
        </header>
        <form method="post" action="/updatecustomer">
            <table>
                <tr> 
                    <td><label for="username">Username</label></td>
                    <td>
                        <input type="text" name="username_cust" class="input-data" value="<?= $customer->username_cust; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td><label for="nama">Email</label></td>
                    <td><input type="text" name="email" class="input-data" value="<?= $customer->Email; ?>"></td>
                </tr>
                <tr>
                    <td colspan="10">
                        <button class="btn-update" style="margin-left: 100px;"><i class="far fa-save"></i> SIMPAN</button>
                    </td>
                </tr>
               
            </table>
            
        </form>
        <button class="btn-back" style="margin-left: 400px;"><a href="/daftarcustomer" style="text-decoration: none; color: black;"><i class="fas fa-chevron-left"></i> KEMBALI</a></button>
    </body>

</html>