<?php
/**
 * Created by PhpStorm.
 * User: dp
 * Date: 5/24/2018
 * Time: 8:02 AM
 */

class Validation
{
    private $_db = null;

    public function __construct()
    {
        $this->_db = Database::Instance();
    }

    protected $errors = [];

    public function Validate($validationRules = array())
    {
        if (empty($validationRules)) throw new PDOException('validation rules not set');

        foreach ($validationRules as $field => $rules) {
            if (isset($_POST[$field])) {
                foreach ($rules as $rule => $ruleValue) {
                    if ($rule === 'required' && Request::post($field) == '') {
                        $this->setErrors($field, $rules['label'] . ' can\'t be empty ');
                    } elseif (Request::post($field) != '') {
                        switch ($rule) {
                            case 'min':
                                if (strlen(Request::post($field)) < $ruleValue) {
                                    $this->setErrors($field, $rules['label'] . ' min ' . $ruleValue . ' character');
                                }
                                break;
                            case 'max':
                                if (strlen(Request::post($field)) > $ruleValue) {
                                    $this->setErrors($field, $rules['label'] . ' max ' . $ruleValue . ' character');
                                }
                                break;
                            case 'email':
                                if (!filter_var(Request::post($field), FILTER_VALIDATE_EMAIL)) {
                                    $this->setErrors($field, $rules['label'] . ' not valid');

                                }
                                break;
                            case 'matches':
                                if (Request::post($field) != Request::post($rules['matches'])) {
                                    $this->setErrors($field, $rules['label'] . ' not match');
                                }
                                break;
                            case 'unique':
                                $dbValue = explode('|', $ruleValue);

                                if ($dbValue < 2) throw new PDOException('unique field required table name and columns name');
                                $tableName = $dbValue[0];
                                $criteria = $dbValue[1];

                                if (count($dbValue) > 3) {
                                    $primaryKey = $dbValue[2];
                                    $primaryKeyValue = $dbValue[3];
                                    if ($dbValue > 3) {
                                        $DataValue = $this->_db->Count($tableName, $criteria . '=? AND '.$primaryKey." !=? ", array(Request::post($field),$primaryKeyValue));
                                        } else {
                                        $DataValue = $this->_db->Count($tableName, $criteria . '=?', array(Request::post($field)));
                                    }

                                    if ($DataValue > 0) {
                                        $this->setErrors($field, $rules['label'] . ' already exit');
                                    }
                                    break;
                                }




                        }
                    }
                }

            }
        }

    }

    /**
     * @param array $errors
     */
    public
    function setErrors($filed, $errorsMessage)
    {
        $this->errors[$filed] = $errorsMessage;
    }

    /**
     * @return array
     */
    public
    function getErrors()
    {
        return $this->errors;
    }


    public
    function isValid()
    {
        if (empty($this->getErrors())) {
            return true;
        }
        return false;


    }

    public
    static function ErrorMessages($class = 'alert alert-danger')
    {
        $errorMessage = Session::get('ErrorMessage');
        $output = '';
        if (empty($errorMessage)) return false;


        foreach ($errorMessage as $message) {
            $output .= "<div class='{$class}'>";
            $output .= $message;
            $output .= "</div>";

        }

        if (isset($message)) {
            Session::delete('ErrorMessage');
            return $output;
        }

        return false;
    }


}