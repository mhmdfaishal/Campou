<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta name="viewport" content="width-device-width , initial-scale=1.0">
    <meta charset="utf-8">
    <title>Login Campou</title>
    <link rel="shortcut icon" href="/assets/img/logo1.png">
    <link rel="stylesheet" href="/assets/style/logon_style.css">
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/glacial-indifference" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
</head>

<body>
    <div class="form">
        <form class="forgotform" action="/sendemail" id="forgotform" method="post">
            <?php if(session()->get('success')) : ?>
                <h4 role="alert" style="padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(8, 124, 37);background-color: rgb(188, 255, 167);color: rgb(8, 124, 37);">
                    <?= session()->get('success')?>
                </h4>
            <?php endif;?>
            <?php if(session()->get('failed')) : ?>
                <h4 role="alert" style="margin:10px auto;width:70%;text-align:center;padding:10px;margin-bottom:10px;border-radius:10px;font-size:14px;border: 1.5px solid rgb(230, 59, 59);background-color: rgb(247, 170, 170);color: rgb(230, 59, 59);">
                    <?= session()->get('failed')?>
                </h4>
            <?php endif;?>
            <input class="user-input" type="text" name="username_cust" placeholder="Your Username" required>
            <button class="btn" type="submit" name="submitemail"><i class="icon fas fa-sign-in-alt"></i> SEND LINK VERIFICATION</button>
            
            
        </form>
    </div>
</body>

</html>