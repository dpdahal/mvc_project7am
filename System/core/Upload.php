<?php

class Upload
{
    private static $_uploadPath = null;
    private static $_uploadSize = 0;
    private static $_uploadExt = array();

    protected static $_uploadError = [
        1 => 'Larger than upload_max_filesize',
        2 => 'MAX_FILE_SIZE',
        3 => 'Partial Upload',
        4 => 'No file Please Select file',
        6 => 'No temporary directory',
        7 => 'Can\'t write to disk',
        8 => 'FILE upload stopped by extension'
    ];

    private static $_imageUploadError = [];

    public static function Configuration($configuration = array())
    {
        if (empty($configuration)) throw new PDOException('configuration not set');
        self::$_uploadPath = rtrim($configuration['upload_path'], '/') . '/';
        self::$_uploadExt = explode('|', $configuration['upload_ext']);
        self::$_uploadSize = (int)$configuration['upload_size'];
    }

    public static function Save($config = array())
    {
        if (empty($config)) throw new PDOException('config not set');
        $ext = strtolower(pathinfo($config['name'], PATHINFO_EXTENSION));
        $fileName = md5(microtime()) . '.' . $ext;
        $error = (int)$config['error'];
        $tmpName = $config['tmp_name'];
        $size = $config['size'];

        if ($error !== 0) {
            self::$_imageUploadError[] = self::$_uploadError[$error];
            return false;
        }
        if (self::$_uploadSize < $size) {
            self::$_imageUploadError[] = ' Max file size ' . (self::$_uploadSize /1000000) . ' mb';
            return false;
        }
        if (!in_array($ext, self::$_uploadExt)) {
            self::$_imageUploadError[] = ' file format ' . implode('|', self::$_uploadExt) . ' supported';
            return false;
        }

        if (!move_uploaded_file($tmpName, self::$_uploadPath . $fileName)) throw new PDOException(' there was a problems');
        return $fileName;


    }

    /**
     * @return array
     */
    public static function getImageUploadError()
    {
        return self::$_imageUploadError;
    }

}