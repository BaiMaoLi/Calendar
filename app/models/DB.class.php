<?php

/* 
 * dal.class.php
 * Data access layer class: used to translate database query results into objects and vice-versa
 */

/**
 * Description of model
 *
 * @author Jam
 */
class DB {
    // Configuration information:
    protected $f3;
    //private static $user = 'devuser123';
    //private static $pass = 'devuser123';
//    private static $config = array(
//        'dev2' =>
//            array('mysql:dbname=dev2;host=127.0.0.1;charset=UTF8'),
//
//      );

    // Static method to return a database connection to a certain pool
    public static function getConnection($pool) {
        
        $f3 = Base::instance();
        $config = array(
        'dev2' =>
            array("mysql:dbname=".$f3->get('db_dns').";host=".$f3->get('db_name').";charset=UTF8"),

        );
        // Make a copy of the server array, to modify as we go:
//        $servers = self::$config[$pool];
        $servers = $config[$pool];
        $connection = false;
        
        // Keep trying to make a connection:
        while (!$connection && count($servers)) {
            $key = array_rand($servers);
            try {
                $connection = new PDO($f3->get('db_dns'),
//                    self::$f3->get('db_user'), self::$f3->get('db_pass'));
                    'devuser123', 'devuser123');
            } catch (PDOException $e) {}
            
            if (!$connection) {
                // Couldn’t connect to this server, so remove it:
                unset($servers[$key]);
            }
        }
        
        // If we never connected to any database, throw an exception:
        if (!$connection) {
            throw new Exception("Failed Pool: {$pool}");
        }

        $db=new DB\SQL(
            'mysql:host=localhost;port=3306;dbname=dev2',
            'devuser123',
            'devuser123'
        );
        
        return $db;
    }
}

/* How to instanciate: $db = DB::getConnection('dev2');     */

