<?php
/**
 * Created by PhpStorm.
 * User: dp
 * Date: 5/22/2018
 * Time: 7:43 AM
 */

class GalleryController extends Model
{
    use Auth;
    protected $tableName = 'tbl_gallery';
    protected $columns = '*';
    protected $primaryKey = 'id=?';
    protected $orderBy = ' id';

    public $_validate = '';

    public function __construct()
    {
        parent::__construct();

        $this->_validate = new Validation();
    }


    public function addGalleryImage()
    {
        $data['cat_id'] = Request::post('cat_id');
        $data['user_id'] = Session::get('user_id');

        try {
            if ($this->_validate->isValid()) {
                $_config['upload_path'] = ROOT . 'Public/images/gallery/';
                $_config['upload_ext'] = 'jpeg|png|jpg|gif';
                $_config['upload_size'] = 20000000;
                Upload::Configuration($_config);
                $fileName = Upload::Save($_FILES['upload']);
                if ($fileName) {
                    $data['image_name'] = $fileName;
                    if ($this->Save($data)) {
                        $_SESSION['success'] = "Information was successfully inserted";
                        Redirect::to('Admin/show_gallery');
                    } else {
                        $_SESSION['error'] = " there was a problems";
                        Redirect::to('Admin/add_gallery');
                    }

                } else {
                    Session::put('ErrorMessage', Upload::getImageUploadError());
                    Redirect::to('Admin/add_gallery');
                }
            }
        } catch (PDOException $exception) {
            die($exception->getMessage());
        }

    }

    public function getAllData()
    {
        $db = Database::Instance();
//        SELECT tbl_gallery.id,tbl_gallery.image_name,GROUP_CONCAT(tbl_image_category.cat_name
// SEPARATOR ',') as category_name,tbl_users.username FROM tbl_gallery
//LEFT JOIN tbl_image_category on tbl_image_category.id=tbl_gallery.cat_id
//LEFT JOIN tbl_users ON tbl_users.id=tbl_gallery.user_id GROUP BY tbl_image_category.cat_name
//        SELECT COUNT(tbl_gallery.image_name) as total_image,tbl_gallery.image_name,GROUP_CONCAT(tbl_image_category.cat_name SEPARATOR ',') as category,tbl_users.username FROM tbl_gallery
//LEFT JOIN tbl_image_category ON tbl_image_category.id=tbl_gallery.id
//LEFT JOIN tbl_users ON tbl_users.id=tbl_gallery.user_id
//GROUP BY tbl_gallery.user_id
        $columns = " COUNT(tbl_gallery.image_name) as total_image,tbl_gallery.image_name,GROUP_CONCAT(tbl_image_category.cat_name SEPARATOR ',') as category,tbl_users.username";
        $clause = "LEFT JOIN tbl_image_category ON tbl_image_category.id=tbl_gallery.id
LEFT JOIN tbl_users ON tbl_users.id=tbl_gallery.user_id
GROUP BY tbl_gallery.user_id";

        return $db->Select($this->tableName, $columns, '', array(), $clause);


    }

    public function getGalleryData()
    {

        return $this->getData();
    }


}