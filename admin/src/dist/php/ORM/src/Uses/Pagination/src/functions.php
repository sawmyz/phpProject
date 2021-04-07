<?php

namespace FwOrm\Uses\Pagination\Base\Functions;

use FwCollection\src\BaseCollection;
use FwOrm\Uses\Pagination\ArrayPaginate;
use FwOrm\Uses\Pagination\CollectionPaginate;
use Generator;

function arrayPaginate(array $array_to_paginate, int $limit = 9): ArrayPaginate {
    return ArrayPaginate::parse($array_to_paginate, $limit);
}

function collectPaginate(BaseCollection $collection, int $limit = 9): CollectionPaginate {
    return CollectionPaginate::parse($collection, $limit);
}

function generatorPaginate(Generator $generator, int $limit = 9): CollectionPaginate {
    return CollectionPaginate::parse(generatorToCollection($generator), $limit);
}
