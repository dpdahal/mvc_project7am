<?php

if(Request::Method() && Token::check(Request::post('token'))){
   $obj = new UserController();
   $obj->addUser();
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
                                <div class="col-md-8">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">

                                            <?=Token::input()  ?>


                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" name="name" id="name" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="username">User Name</label>
                                                <input type="text" name="username" id="username" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" id="email" class="form-control">
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="user_type">User Type</label>
                                                        <select name="user_type" id="user_type" class="form-control">
                                                            <option value="user">User</option>
                                                            <option value="admin">Admin</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="1">Active</option>
                                                            <option value="0">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="image_upload">Profile Picture</label>
                                                        <input type="file" name="upload" id="change_image"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password"
                                                       class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="cpassword">Password Confirm</label>
                                                <input type="password" name="password_confirmation" id="password"
                                                       class="form-control">
                                            </div>


                                            <div class="form-group">
                                                <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Record
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-4">
                                    <?=Validation::errorMessages()?>

                                    <img src="<?= BASE_URL . 'Public/images/icons/not_found.jpg' ?>" id="target_image"
                                         alt="image not found" class="img-responsive thumbnail"
                                         style="margin-top: 22px;">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->