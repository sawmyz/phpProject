<?php

namespace fwTools\all;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;
use stdClass;

class Models {
    const key = 'name';
    const table = 'name';

    public function getAll() {
        foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'models/')), '/\.php$/') as $phpFile) {
            $obj = new stdClass();
            $obj->name = basename($phpFile->getFileName(), '.php');
	        $fileName = $phpFile->getFileName();
	        $fileName  = str_replace('.php','',$fileName);
	        $class = "\model\\$fileName";
	        if (class_exists($class)) {
		        $class = new $class();
		        $obj->key = $class->_key;
		        yield $obj;
	        }
        }
    }
}
