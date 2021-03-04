<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta name="viewport" content="width-device-width , initial-scale=1.0">
    <meta charset="utf-8">
    <title>Login Campou</title>
    <link rel="shortcut icon" href="assets/img/logo1.png">
    <link rel="stylesheet" href="assets/style/logon_style.css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/glacial-indifference" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
    <div class="form">
        <form class="login-form" action="/afterlogin" method="POST">
            <i class="fa fa-user-circle"></i>
            <?php if(session()->get('success')) : ?>
                <h4 role="alert" style="padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(8, 124, 37);background-color: rgb(188, 255, 167);color: rgb(8, 124, 37);">
                    <?= session()->get('success')?>
                </h4>
            <?php endif;?>
            <?php if(session()->get('gagal')) : ?>
                <h4 role="alert" style="padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(230, 59, 59);background-color: rgb(247, 170, 170);color: rgb(230, 59, 59);">
                    <?= session()->get('gagal')?>
                </h4>
            <?php endif;?>
            <input class="user-input" type="text" name="username" placeholder="Username" required>
            <input class="user-input" type="password" name="password" placeholder="Password" required>
            <div class="choose-act1">
                <label class="remember-me">
                    <input type="checkbox" name="remember_me">Remember Me</label>
                <div class="choose-act4">
                    <a href="/login/forgotpage">Forgot Your Password?</a>
                </div>
            </div>
            <button class="btn" type="submit" name="signin"><i class="icon fas fa-sign-in-alt"></i> SIGN IN</button>
            <div class="choose-act2">
                <p>Not Registered?<a href="#" onclick="$('#forgotform');"> Create an Account</a></p>
            </div>
           
        </form>
        
        <form class="signup-form" action="/register" method="POST" enctype="multipart/form-data">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
            <?php if(session()->get('gagal')) : ?>
                <h4 role="alert" style="padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(230, 59, 59);background-color: rgb(247, 170, 170);color: rgb(230, 59, 59);">
                    <?= session()->get('gagal')?>
                </h4>
            <?php endif;?>
            <table>
                <tr>
                    <td><input class="user-input" type="text" name="username" placeholder="Username" required></td>
                </tr>
                <tr>
                    <td><input class="user-input" type="email" name="email" placeholder="Email" required></td>
                </tr>
                <tr>
                    <td><input class="user-input" type="password" name="password" placeholder="Password" required></td>
                </tr>
                <tr>
                    <td><input class="user-input" type="password" name="password_confirm" placeholder="Re-Type Password" required></td>
                </tr>
                
                <tr>
                    <td>MASUKKAN FOTO ANDA<input class="btn-pic" id="foto" name="foto" type="file" onchange="$('#foto').html($(this).val());" required></td>
                </tr>
                <tr>
                    <td>
                        <div>
                            <span class='btn-pic' id="foto"></span>
                        </div>
                    </td>
                </tr>
            </table>
            <button class="btn" type="submit" name="signup-btn">SIGN UP</button>
        
            <div class="choose-act3">
                <p>Already Registered?<a href="#"> Sign In</a></p>
            </div>
            
        </form>
    </div>
    <script type="text/javascript">
        $('.choose-act2 a').click(function() {
            $('form').animate({
                height: "toggle",
                opacity: "toggle"
            }, "slow");
        });
    </script>
    <script type="text/javascript">
        $('.choose-act3 a').click(function() {
            $('form').animate({
                height: "toggle",
                opacity: "toggle"
            }, "slow");
        });
    </script>
    <script type="text/javascript">
        $('.choose-act4 a').click(function() {
            $('forgotform').animate({
                height: "toggle",
                opacity: "toggle"
            }, "slow");
        });
    </script>
</body>

</html>