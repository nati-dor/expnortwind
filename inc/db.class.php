<?php

class db
{
    private static $master = null;
    public static function master()
    {
        if (!self::$master)
		{
			self::$master = mysqli_init();
            self::$master->real_connect(config::DB_HOSTNAME, config::DB_USERNAME, config::DB_PASSWORD, config::DB_DATABASE);
            self::$master->set_charset('utf8');
		}
        
        return self::$master;   
    }
}