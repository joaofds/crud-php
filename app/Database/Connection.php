<?php

namespace App\Database;

use PDO;

class Connection
{
    public static ?PDO $connection = null;

    public static function getConnetion()
    {
        if (!self::$connection) {
            self::$connection = new PDO(
                DATA_LAYER_CONFIG['driver'] . ':host=' . DATA_LAYER_CONFIG['host'] . ';dbname=' . DATA_LAYER_CONFIG['dbname'] . ';port=' . DATA_LAYER_CONFIG['port'],
                DATA_LAYER_CONFIG['username'],
                DATA_LAYER_CONFIG['passwd'],
                DATA_LAYER_CONFIG['options']
            );
        }

        return self::$connection;
    }
}
