<?php
namespace FwOrm\Uses\Pagination\Base;
if (!class_exists('FwOrm\Uses\Pagination\Base\BasePagination')) {
    abstract class BasePagination implements \Iterator {
        /**
         * @var array<Page>
         */
        protected $pages = [];
        /**
         * @var int
         */
        protected $current_page = 0;
        /**
         * @var int
         */
        protected $total_pages = 0;
        /**
         * @var int
         */
        protected $pagination_count = 0;
        /**
         * limit
         * @var int
         */
        protected $data_per_page = 9;

        public function __debugInfo() {
            return get_object_vars($this);
        }

        public function previousPage() : int{
            return --$this->current_page;
        }

        public function nextPage() : int{
            return ++$this->current_page;
        }

        public function firstPage() {
            return $this->pages[0];
        }

        public function lastPage() {
            return $this->pages[$this->total_pages - 1];
        }

        public function nthPage(int $n): Page {
            return $this->pages[$n];
        }

        public function pageCount(): int {
            return $this->total_pages;
        }

        public function btnCount() : int {
            return $this->pagination_count;
        }

        public function currentPageIndex(): int {
            return $this->current_page;
        }

        public function currentPage(): Page {
            return $this->pages[$this->current_page];
        }


        public function current() {
            return $this->pages[$this->key()];
        }

        public function next() {
            return $this->pages[$this->nextPage()];
        }

        public function key() {
            return $this->current_page;
        }

        public function valid() {
            return isset($this->pages[$this->key()]);
        }

        public function rewind() {
            reset($this->pages);
        }
    }
}
