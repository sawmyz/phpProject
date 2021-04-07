<?php
namespace helpers\action;
use DATABASE\ORM\QueryBuilder\QueryBuilder\Db;

if (!class_exists('helpers\action\Actions')){
    class Actions {
        public static function add($row) {
            $Db = Db::table('actions');
            $Db->insert((array)$row);
        }

        public static function get(string $table,$id,string $action) {

            $Db = Db::table('actions');
            return $Db->where(['tblName' => $table,'row_id' => $id,'action_type' => $action])->get()->first();
        }
    }
}
