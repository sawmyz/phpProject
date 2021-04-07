<?php

namespace FwMigrationSystem\User;

use FwMigrationSystem\Main\Migratable;
use FwMigrationSystem\Main\Migration;
use FwMigrationSystem\Resources\Blueprint;
use FwMigrationSystem\Resources\TableName;

class DegreesMigration extends Migratable {
    const modelName = 'Degrees';

    public function create_table() {
        return Migration::Create(new TableName(self::modelName), function (Blueprint $blueprint) {
            $blueprint->primary_key('degree_id');
			$blueprint->VarChar('degree_name')->Len(150);
			$blueprint->VarChar('degree_minim')->Len(150);
			$blueprint->VarChar('degree_max')->Len(150);

             return $blueprint;
        });
    }

    public function drop_table() {
        return Migration::DropIfExists(new TableName(self::modelName));
    }
}
