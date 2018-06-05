<?php

$obj = new GalleryController();
$galleryData=$obj->getAllData();




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
                                <?=Messages() ?>
                                <table id="datatable" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Category Name</th>
                                        <th>Posted By</th>
                                        <th>Total Image</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>


                                    <tbody>
                                        <?php foreach ($galleryData as $key => $gallery): ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $gallery->category ?></td>
                                                <td><?= $gallery->username ?></td>
                                                <td>
                                                    <?=$gallery->total_image?>
                                                </td>
                                                <td>
                                                    <a href="" class="btn btn-success btn-sm">View Images</a>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>


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

<!-- /page content -->