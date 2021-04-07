<?php

namespace FwMigrationSystem\Resources\Helpers;

if (!class_exists('FwMigrationSystem\Resources\Helpers\Types')) {
    class Types {
        const VarChar = 'VARCHAR';
        const Int = 'INT';
        const Float = 'FLOAT';
        const BigInt = 'BIGINT';
        const TinyInt = 'TinyInt';
        const Text = 'TEXT';
        const LongText = 'LONGTEXT';
        const ShortText = 'SHORTTEXT';
        const TimeStamp = 'TIMESTAMP';
    }
}
