<?php

namespace FwOrm\Uses\Pagination;

use FwOrm\Uses\Pagination\Base\BasePagination;
use FwOrm\Uses\Pagination\Base\Page;

class ArrayPaginate extends BasePagination {
    public static function parse(array $array_to_paginate, int $limit = 9) {
        $instance = new self();
        $chunked = array_chunk($array_to_paginate, $limit);
        $pages = [];

        foreach ($chunked as $i => $value) {
            if (is_array($value)){
                $value = collect($value);
            }
            $pages[] = new Page($value, $i);
        }
        $instance->pages = $pages;
        $instance->total_pages = count($chunked);
        $instance->data_per_page = $limit;
        $instance->current_page = 0;
        $instance->pagination_count = ceil(count($chunked) / $limit);
        return $instance;
    }


}
