<?php


class SliderController extends Model
{

    protected $tableName = 'tbl_slider';
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
        'title' => [
            'required' => true,
            'min' => 3,
            'max' => 200,
            'label' => ' title '
        ],
        'description' => [
            'required' => true,
            'label' => ' description'
        ],



    ];

    public function addSlider()
    {
        $data['title'] = Request::post('title');
        $data['description'] = Request::post('description');

        try {

            $this->_validate->Validate($this->_validationRules);

            if ($this->_validate->isValid()) {

                $_config['upload_path'] = ROOT . 'Public/images/slider/';
                $_config['upload_ext'] = 'jpeg|png|jpg|gif';
                $_config['upload_size'] = 2000000;
                Upload::Configuration($_config);
                $fileName = Upload::Save($_FILES['upload']);
                if ($fileName) {
                    $data['image'] = $fileName;
                    if ($this->Save($data)) {
                        $_SESSION['success'] = "Information was successfully inserted";
                        Redirect::to('Admin/show_slider');
                    } else {
                        $_SESSION['error'] = " there was a problems";
                        Redirect::to('Admin/add_slider');
                    }

                } else {
                    Session::put('ErrorMessage', Upload::getImageUploadError());
                    Redirect::to('Admin/add_slider');
                }


            } else {
                Session::put('ErrorMessage', $this->_validate->getErrors());
                Redirect::to('Admin/add_slider');


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