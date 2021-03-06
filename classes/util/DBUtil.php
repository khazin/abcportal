<?php
namespace classes\util;

use mysqli;
/**
 * 
 * @author Khazin
 *
 */
class DBUtil
{
    /**
     * 
     * @return \mysqli
     */
    public static function getConnection(){
        $config = Config::getConfig();
        $conn   = new mysqli($config->mysqlServer, $config->mysqlUser, $config->mysqlPassword, $config->mysqlDB);
        return $conn;
    }
}
