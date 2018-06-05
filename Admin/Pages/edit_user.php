<?php
$userData = Session::get('userData');

$obj = new UserController();


if (Request::Method() && Token::check(Request::post('token'))) {

    if (isset($_POST['update_info'])) {
        $obj->updateUserInfo();


    }

    if (isset($_POST['update_password'])) {

      $obj->updatePassword();
    }


}


?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Admin : : <?= $title ?></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Settings 1</a>
                                    </li>
                                    <li><a href="#">Settings 2</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="row">
                            <div class="col-md-12">

                                <?php $token=Token::input()  ?>
                                <div class="col-md-8">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <?=$token ?>
                                            <input type="hidden" name="user_id" value="<?= $userData->id ?>">

                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" value="<?= $userData->name ?>" id="name"
                                                       class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="username">User Name</label>
                                                <input type="text" name="username" value="<?= $userData->username ?>"
                                                       id="username" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" value="<?= $userData->email ?>"
                                                       id="email" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="image_upload">Profile Picture</label>
                                                <input type="file" name="upload" id="change_image"
                                                       class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <button name="update_info" class="btn btn-primary"><i
                                                            class="fa fa-edit"></i> Update Info
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <?= Validation::errorMessages() ?>

                                    <img src="<?= BASE_URL . 'Public/images/users/' . $userData->image ?>"
                                         id="target_image"
                                         alt="image not found" class="img-responsive thumbnail"
                                         style="margin-top: 22px;">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h1>update password</h1>
                                <hr>
                                <div class="row">
                                    <form action="" method="post">
                                        <?=$token?>
                                        <input type="hidden" name="user_id" value="<?=$userData->id?>">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="old_password">Old Password</label>
                                                <input type="password" name="old_password" id="old_password"
                                                       class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <label for="cpassword">Password Confirm</label>
                                                <input type="password" name="password_confirmation" id="password"
                                                       class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <button name="update_password" class="btn btn-primary "><i class="fa fa-lock"></i> Update
                                                    Password
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
