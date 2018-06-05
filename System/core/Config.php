<?php
/**
 * Created by PhpStorm.
 * User: dp
 * Date: 5/23/2018
 * Time: 8:19 AM
 */

class Config
{

    public static function get($config = '')
    {
        if (empty($config)) throw new PDOException('db config not set');
        $dbValue = explode('.', $config);
        $configGlobalValue = $GLOBALS['configs'];

        foreach ($dbValue as $value) {
            if (isset($configGlobalValue)) {
                $configGlobalValue = $configGlobalValue[$value];
            }

        }

        if (!is_array($configGlobalValue)) {
            return $configGlobalValue;
        }


        return false;

    }

}