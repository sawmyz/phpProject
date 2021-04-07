<?php

use FwCollection\src\BaseCollection;

function collect(array $array) : BaseCollection {
    return new BaseCollection($array);
}
function generatorToCollection(Generator $generator) : BaseCollection {
    $output = [];
    foreach ($generator as $value){
        $output[] = $value;
    }
    return collect($output);
}
