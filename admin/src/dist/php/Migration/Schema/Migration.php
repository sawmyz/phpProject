<?php

namespace FwMigrationSystem\Main;
include __BASE_DIR__ . 'src/conf/connection.php';

use FwConnection;
use FwMigrationSystem\Resources\Blueprint;
use FwMigrationSystem\Resources\TableName;

if (!class_exists('FwMigrationSystem\Main\Migration')) {
    class Migration
    {
        public static function Create(TableName $tableName, callable $callback)
        {
            $table = call_user_func_array($callback, array(new Blueprint($tableName)));
            $tableName = str_replace('tbl', '', $tableName->__toString());
            $query = $table->getQuery();
            $time = time();
            if (FwConnection::conn()->query("INSERT INTO migration_table (`tblName`,`date_time`,`fields`,`type`,`client`) VALUES ('$tableName', '$time', '{$table->__toString()}','create','cli_migration')")) {
                if (FwConnection::conn()->query($query)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        public static function DropIfExists(TableName $tableName)
        {
            $time = time();
            FwConnection::conn()->query("INSERT INTO migration_table (`tblName`,`date_time`,`fields`,`type`,`client`) VALUES ('$tableName', '$time', '[]','delete','cli_migration')");
            return FwConnection::conn()->query("DROP TABLE IF EXISTS $tableName");
        }
    }
}
