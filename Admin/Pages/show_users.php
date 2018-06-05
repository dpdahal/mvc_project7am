<?php

$obj = new UserController();
$allUsersData = $obj->getAllData();

if (Request::Method()) {
    if (isset($_POST['admin'])) {
        $obj->updateUserType();
    }

    if (isset($_POST['user'])) {
        $obj->updateUserType();
    }


}

if (Request::Method()) {

    if (isset($_POST['active'])) {
        $obj->updateUserStatus();
    }

    if (isset($_POST['inactive'])) {
        $obj->updateUserStatus();
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
                                <?= Messages(); ?>

                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Name</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>User Type</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                    <?php if (count($allUsersData) > 0) : ?>
                                        <?php foreach ($allUsersData as $key => $users): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $users->name ?></td>
                                                <td><?= $users->username ?></td>
                                                <td><?= $users->email ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="user_id" value="<?= $users->id ?>">
                                                        <?php if ($users->user_type == 'admin') : ?>
                                                            <button name="admin" class="btn btn-primary btn-xs">admin
                                                            </button>
                                                        <?php else: ?>
                                                            <button name="user" class="btn btn-info btn-xs">User
                                                            </button>
                                                        <?php endif; ?>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="user_id" value="<?= $users->id ?>">
                                                        <?php if ($users->status == 1) : ?>
                                                            <button name="active" class="btn btn-primary btn-xs">
                                                                Active
                                                            </button>
                                                        <?php else: ?>
                                                            <button name="inactive" class="btn btn-info btn-xs">
                                                                Inactive
                                                            </button>
                                                        <?php endif; ?>
                                                    </form>
                                                </td>
                                                <td>
                                                    <img src="<?= public_path('images/users/' . $users->image) ?>"
                                                         alt="image not found" width="30">
                                                </td>
                                                <td>
                                                    <?php if (Session::get('user_type') == 'admin') : ?>
                                                        <a href="<?= BASE_URL . 'Admin/edit.php?criteria=' . $users->id ?>"
                                                           class="btn btn-primary btn-xs"> <i
                                                                    class="fa fa-pencil"></i> Edit</a>
                                                        <a href="<?= BASE_URL . 'Admin/delete.php?criteria=' . $users->id ?>"
                                                           class="btn btn-danger btn-xs"> <i
                                                                    class="fa fa-trash"></i> Delete</a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="8" align="center">Data not found</td>
                                        </tr>


                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

