<?php
namespace FwOrm\Utils\Deals\Convertables;
use fwJson\Json;

if (!interface_exists('FwOrm\Utils\Deals\Convertables\Jsonable')){
    interface Jsonable {
        /**
         * @param int $options
         * @return Json
         */
        public function toJson($options = 0) : Json;
    }
}
