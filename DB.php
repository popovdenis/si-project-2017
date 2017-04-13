<?php
include_once 'config.php';

class DB
{
    private static $link = null;
    
    private function __construct()
    {
    }
    
    private function __clone()
    {
    }
    
    private function __sleep()
    {
    }
    
    private function __wakeup()
    {
    }
    
    public static function getInstance()
    {
        if (self::$link === null) {
            self::$link = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);
            if (!empty(self::$link->connect_error)) {
                die(self::$link->connect_error);
            }
            if (!self::$link->select_db(DB_NAME)) {
                die(self::$link->error);
            }
            self::$link->query('SET NAMES utf8');
        }
    
        return self::$link;
    }
}
