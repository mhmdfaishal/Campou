<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta name="viewport" content="width-device-width , initial-scale=1.0">
    <meta charset="utf-8">
    <title>Admin Campou</title>
    <link rel="shortcut icon" href="assets/img/logo1.png">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/glacial-indifference" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="assets/style/logonadmin_style.css">
</head>

<body>
    <div class="form">
        <form class="login-form" action="/admin/login" method="POST">
            <i class="fas fa-user-lock"></i>
            <?php if(session()->get('gagal')) : ?>
                <h4 role="alert" style="padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(230, 59, 59);background-color: rgb(247, 170, 170);color: rgb(230, 59, 59);">
                    <?= session()->get('gagal')?>
                </h4>
            <?php endif;?>
            <h2>Admin</h2>
            <input class="user-input" type="text" name="idpenyedia" placeholder="ID ADMIN" required>
            <input class="user-input" type="password" name="password" placeholder="Password" required>
            <button class="btn" type="submit" name="signin"><i class="icon fas fa-sign-in-alt"></i> SIGN IN</button>
        </form>
    </div>
</body>

</html>