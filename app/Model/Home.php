<?php

namespace App\Model;

use \Core\Model;
use \Core\DataBase;
use \App\Config\Database as DatabaseConfig;

/**
 * Example user model
 *
 * PHP version 7.0
 */
class Home extends Model
{
    protected $table = 'home';
   
    /**
     *
     * @return array
     */
    public static function getHome()
    {
        $db = new DataBase( 
            DatabaseConfig::DB_NAME,
            DatabaseConfig::DB_HOST,
            DatabaseConfig::DB_USER,
            DatabaseConfig::DB_PASSWORD
        );

        $sql = 'select `version` from `home`  ';
        $data = $db->fetchAll( $sql );
        return  array_column( $data , 'version' ) ;
    }
}
