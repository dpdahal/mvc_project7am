<?php


class ImageCategoryController extends Model
{
    use Auth;
    protected $tableName = 'tbl_image_category';
    protected $columns = '*';
    protected $primaryKey = 'id=?';
    protected $orderBy = ' id';

    public $_validate = '';

    public function __construct()
    {
        parent::__construct();

        $this->_validate = new Validation();
    }

    protected $_validationRules = [
        'cat_name' => [
            'required' => true,
            'min' => 3,
            'max' => 20,
            'label' => 'category name '
        ]


    ];

    public function addImageCategory()
    {
        $data['cat_name'] = Request::post('cat_name');


        try {

            $this->_validate->Validate($this->_validationRules);

            if ($this->_validate->isValid()) {
                if ($this->Save($data)) {
                    $_SESSION['success'] = 'Information was successfully inserted';
                    Redirect::to('Admin/add_image_category');
                }

            } else {
                Session::put('ErrorMessage', $this->_validate->getErrors());
                Redirect::to('Admin/add_image_category');


            }


        } catch (PDOException $exception) {
            die($exception->getMessage());
        }

    }

    public function getAllData($criteria = null)
    {

        return $this->getData($criteria);


    }


}