<?php
namespace classes\util;

/**
 *
 * @author Khazin
 *
 */
class Config
{
    public static $config;
    public $mysqlServer;
    public $mysqlUser;
    public $mysqlPassword;
    public $mysqlDB;

    /**
     *
     * @param boolean $reload
     * @return \classes\util\Config
     */
    public static function getConfig($reload = false){
        if( isset($config) == false || $reload == true ) {
            $ini =  parse_ini_file(self::getApplicationRoot()."/config/phpcrudsample.ini");
            $config = new Config();
            $config->mysqlServer   = $ini['mysqlserver'];
            $config->mysqlUser     = $ini['mysqluser'];
            $config->mysqlPassword = $ini['mysqlpassword'];
            $config->mysqlDB       = $ini['mysqldb'];
            return $config;
        }
        return $config;
    }

    /**
     *
     * @return string
     */
    public static function getApplicationRoot(){
        $path = $_SERVER['DOCUMENT_ROOT'] . "/students/sg0318a11/abcportal";
        return $path;
    }
}
