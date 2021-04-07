<?php
namespace FwOrm\Utils\Deals\Convertables;
if (!interface_exists('FwOrm\Utils\Deals\Convertables\Arrayable')){
    interface Arrayable {
        /**
         * Get the instance as an array.
         *
         * @return array
         */
        public function toArray() : array;
    }
}
