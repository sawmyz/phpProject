<?php

namespace FwMigrationSystem\ErrorHandling;
use Exception;

if (!class_exists('FwMigrationSystem\ErrorHandling\MigrationException')) {

    class MigrationException extends Exception {

    }
}
