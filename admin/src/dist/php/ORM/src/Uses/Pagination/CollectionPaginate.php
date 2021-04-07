<?php

namespace FwOrm\Uses\Pagination;

use FwCollection\src\BaseCollection;
use FwOrm\Uses\Pagination\Base\BasePagination;
use FwOrm\Uses\Pagination\Base\Page;

class CollectionPaginate extends BasePagination {
    public static function parse(BaseCollection $collection, int $limit = 9) {
        $instance = new self();
        $chunked = $collection->chunk($limit);
        $pages = [];
        foreach ($chunked as $i => $value) {

            $pages[] = new Page($value, $i);
        }
        $instance->pages = $pages;
        $instance->total_pages = $chunked->length();
        $instance->data_per_page = $limit;
        $instance->current_page = 0;
        $instance->pagination_count = ceil($chunked->length() / $limit);
        return $instance;
    }


}
