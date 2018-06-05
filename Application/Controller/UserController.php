<?php
/**
 * Created by PhpStorm.
 * User: dp
 * Date: 5/22/2018
 * Time: 7:43 AM
 */

class UserController extends Model
{
    use Auth;
    protected $tableName = 'tbl_users';
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
        'name' => [
            'required' => true,
            'min' => 3,
            'max' => 20,
            'label' => ' name '
        ],
        'username' => [
            'required' => true,
            'unique' => 'tbl_users|username',
            'min' => 3,
            'max' => 10,
            'label' => ' username'
        ],

        'email' => [
            'required' => true,
            'email' => true,
            'unique' => 'tbl_users|email',
            'label' => ' email '
        ],
        'password' => [
            'required' => true,
            'min' => 5,
            'max' => 20,
            'label' => ' password'
        ],
        'password_confirmation' =>
            [
                'required' => true,
                'matches' => 'password',
                'label' => 'password_confirmation'

            ]


    ];

    public function addUser()
    {
        $data['name'] = Request::post('name');
        $data['username'] = Request::post('username');
        $data['email'] = Request::post('email');
        $data['user_type'] = Request::post('user_type');
        $data['status'] = Request::post('status');
        $data['password'] = Hash::has(Request::post('password'));
        try {


            $this->_validate->Validate($this->_validationRules);

            if ($this->_validate->isValid()) {

                $_config['upload_path'] = ROOT . 'Public/images/users/';
                $_config['upload_ext'] = 'jpeg|png|jpg|gif';
                $_config['upload_size'] = 2000000;
                Upload::Configuration($_config);
                $fileName = Upload::Save($_FILES['upload']);
                if ($fileName) {
                    $data['image'] = $fileName;
                    if ($this->Save($data)) {
                        $_SESSION['success'] = "Information was successfully inserted";
                        Redirect::to('Admin/show_users');
                    } else {
                        $_SESSION['error'] = " there was a problems";
                        Redirect::to('Admin/addUser');
                    }

                } else {
                    Session::put('ErrorMessage', Upload::getImageUploadError());
                    Redirect::to('Admin/addUser');
                }


            } else {
                Session::put('ErrorMessage', $this->_validate->getErrors());
                Redirect::to('Admin/addUser');


            }


        } catch (PDOException $exception) {
            die($exception->getMessage());
        }

    }

    public function getAllData($criteria = null)
    {
        if (Session::get('user_type') !== 'admin') {
            $criteria = Session::get('user_id');
            $this->getData($criteria);
        }
            return $this->getData($criteria);



    }

    public function updateUserType()
    {
        $criteria = Request::post('user_id');
        if (isset($_POST['admin'])) {
            $data['user_type'] = 'user';

        }
        if (isset($_POST['user'])) {
            $data['user_type'] = 'admin';
        }

        if ($this->Save($data, $criteria)) {
            $_SESSION['success'] = 'information was successfully updated';
            Redirect::to('Admin/show_users');
        }
    }

    public function updateUserStatus()
    {
        $criteria = Request::post('user_id');
        if (isset($_POST['active'])) {
            $data['status'] = 0;

        }
        if (isset($_POST['inactive'])) {
            $data['status'] = 1;
        }

        if ($this->Save($data, $criteria)) {
            $_SESSION['success'] = 'information was successfully updated';
            Redirect::to('Admin/show_users');
        }

    }

    public function deleteImage($criteria = '')
    {
        $id = $criteria;
        $findData = $this->getData($id);
        $findImage = $findData->image;
        $deleteImagePath = public_path('images/users/' . $findImage, true);
        if (file_exists($deleteImagePath) && is_file($deleteImagePath)) {
            return unlink($deleteImagePath);
        }
        return true;

    }

    public function deleteUser($criteria = '')
    {
        if (empty($criteria)) return false;
        $id = (int)$criteria;
        if ($this->deleteImage($id) && $this->Delete($id)) {
            $_SESSION['success'] = 'information was successfully deleted';
            Redirect::to('Admin/show_users');
        }
        return false;

    }

    public function editUser($criteria = '')
    {
        if (empty($criteria)) return false;
        $id = $criteria;
        Session::put('userData', $findData = $this->getByCriteria($id));
        Redirect::to('Admin/edit_user');
    }

    public function updateUserInfo()
    {
        $criteria = Request::post('user_id');
        $data['name'] = Request::post('name');
        $data['username'] = Request::post('username');
        $data['email'] = Request::post('email');
        try {
            $this->_validationRules['username']['unique'] = 'tbl_users|username|id|' . $criteria;
            $this->_validationRules['email']['unique'] = 'tbl_users|email|id|' . $criteria;
            $this->_validate->Validate($this->_validationRules);

            if ($this->_validate->isValid()) {

                if (!empty($_FILES['upload']['name'])) {
                    $_config['upload_path'] = ROOT . 'Public/images/users/';
                    $_config['upload_ext'] = 'jpeg|png|jpg|gif';
                    $_config['upload_size'] = 2000000;
                    Upload::Configuration($_config);
                    $fileName = Upload::Save($_FILES['upload']);
                    if ($this->deleteImage($criteria) && $fileName) {
                        $data['image'] = $fileName;
                    } else {
                        Session::put('ErrorMessage', Upload::getImageUploadError());
                        Redirect::to('Admin/edit_user');
                    }
                }

                if ($this->Save($data, $criteria)) {
                    $_SESSION['success'] = "Information was successfully updated";
                    Redirect::to('Admin/show_users');
                } else {
                    $_SESSION['error'] = " there was a problems";
                    Redirect::to('Admin/show_users');
                }


            } else {
                Session::put('ErrorMessage', $this->_validate->getErrors());
                Redirect::to('Admin/edit_user');


            }


        } catch (PDOException $exception) {
            die($exception->getMessage());
        }


    }

    public function updatePassword()
    {
        $criteria = Request::post('user_id');
        $oldPassword = Request::post('old_password');
        $userData = $this->getData($criteria);
        $hashPassword = $userData->password;
        if (Hash::decrypt($oldPassword, $hashPassword)) {
            try {
                $data['password'] = Hash::has(Request::post('password'));
                $this->_validate->Validate($this->_validationRules);
                if ($this->_validate->isValid()) {
                    if ($this->Save($data, $criteria)) {
                        $_SESSION['success'] = 'password was successfully updated';
                        Redirect::to('Admin/show_users');
                    }


                } else {
                    Session::put('ErrorMessage', $this->_validate->getErrors());
                    Redirect::to('Admin/edit_user');
                }


            } catch (PDOException $exception) {
                die($exception->getMessage());
            }


        } else {
            $_SESSION['error'] = 'password not match';
            Redirect::to('Admin/edit_user');
        }
    }

    public function login()
    {
        $userName = Request::post('username');
        $password = Request::post('password');
        $this->isLogIn($userName, $password);
    }


}