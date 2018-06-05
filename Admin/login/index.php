<?php
require_once "../../Config/Config.php";
require_once(ROOT . 'Vender/Autoload/Autoload.php');
if(Request::Method() && Token::check(Request::post('token'))){
  $obj = new UserController();
  $obj->login();
}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL . 'Public/backend/vendors/bootstrap/dist/css/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'Public/backend/vendors/font-awesome/css/font-awesome.min.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'Public/backend/vendors/nprogress/nprogress.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'Public/backend/vendors/iCheck/skins/flat/green.css' ?>">
    <link rel="stylesheet" href="<?= BASE_URL . 'Public/backend/build/css/custom.min.css' ?>">
</head>
<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <?=Messages()?>
                <form method="post" action="">
                    <?=Token::input()  ?>
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" name="username" class="form-control" placeholder="Username" required="" />
                    </div>
                    <div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                    </div>
                    <div>
                       <button class="btn btn-primary">Log In</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">


                        <div class="clearfix"></div>

                        <div>
                            <h1><i class="fa fa-paw"></i> project7am</h1>
                         </div>
                    </div>
                </form>
            </section>
        </div>


    </div>
</div>
</body>
</html>