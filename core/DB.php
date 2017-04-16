<?php
trait DB
{
    /**
     * @var null|mysqli
     */
    private static $link = null;
    
    /**
     * Return an object of mysql class to work with database.
     *
     * @return \mysqli|null
     */
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
    
    /**
     * Clean a value from space and html tags.
     *
     * @param string $value String value
     *
     * @return string
     */
    public function clean($value)
    {
        return strip_tags(trim($value));
    }
    
    /**
     * Escape a value.
     *
     * @param string $value String value.
     *
     * @return string
     */
    public function escape($value)
    {
        return self::getInstance()->real_escape_string($value);
    }
}
