<?php

namespace FwOrm\AddOns;
if (!class_exists("FwOrm\AddOns\SoftDeletes")) {
	trait SoftDeletes {
		public static $softDelete = 'deleted_at';

		public static function softDelete($id) {
			return static::edit($id, [
				static::$softDelete => date("Y-m-d H:i:s"),
			]);
		}
	}
}
