<?php

namespace FwOrm\Uses\Pagination\Base;

use DATABASE\ORM\Interact\Entities\EntityScheme;
use DATABASE\ORM\QueryBuilder\DBCollection;
use stdClass;

if (!class_exists('FwOrm\Uses\Pagination\Base\Page')) {
    class Page {
        /**
         * @return DBCollection|EntityScheme|stdClass
         */
        public function getData() {
            return $this->_data;
        }

        /**
         * @return int
         */
        public function getPageIndex(): int {
            return $this->_page_index;
        }

        private $_data;
        private $_page_index;

        /**
         * Page constructor.
         * @param $_data
         * @param int $_page_index
         */
        public function __construct($_data, int $_page_index) {
            $this->_data = $_data;
            $this->_page_index = $_page_index;
        }

        public function __debugInfo() {
            return ['pageIndex' => $this->getPageIndex(), 'pageData' => $this->getData()];
        }
    }
}
