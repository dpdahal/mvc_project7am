<?php
$obj = new GalleryController();
$catObj= new ImageCategoryController();
$catData=$catObj->getAllData();

if (Request::Method() && Token::check(Request::post('token'))) {
    $obj->addGalleryImage();


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
                                <?=Messages() ?>
                                <?=Validation::ErrorMessages() ?>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <?= Token::input() ?>
                                    <div class="form-group">
                                        <label for="cat_name">Select Category</label>
                                        <select name="cat_id" id="cat_name" class="form-control">
                                            <option selected disabled>--Select Category--</option>
                                           <?php foreach ($catData as $cat) : ?>
                                            <option value="<?=$cat->id?>"><?=$cat->cat_name?></option>
                                            <?php endforeach;  ?>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        <label for="image">Category Name</label>
                                        <input type="file" name="upload" id="image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary"><i class="fa fa-plus"></i> Add Record
                                        </button>
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

<!-- /page content -->