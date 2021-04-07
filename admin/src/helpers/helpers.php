<?php
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('Asia/Tehran');
require_once 'noSoap.php';
if (!function_exists('showSuccessMsg')) {
	function showSuccessMsg($name, $type) {
		return '<div class="alert alert-success alert-dismissible mrt20">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fa fa-check"></i> ' . $type . ' ' . $name . ' با موفقیت انجام شد!</h5>
				  </div>';
	}
}
if (!function_exists('get_header')) {
	/**
	 *
	 * @return string|null header value or null if not found
	 * @var string $headerName case insensitive header name
	 */
	function get_header(string $headerName) {
		$headers = getallheaders();
		return isset($headerName) ? $headers[$headerName] : NULL;
	}
}
if (!function_exists('is_in_polygon')) {
	function is_in_polygon($polygon, $longitude_x, $latitude_y) {
		$c = 0;
		$tmp_str = str_replace('(', '', $polygon);
		$tmp_str = str_replace(' ', '', $tmp_str);
		$tmp_str = substr($tmp_str, 0, strlen($tmp_str) - 1);
		$polygon = explode(')', $tmp_str);
		$vertices_x = [];
		$vertices_y = [];
		foreach ($polygon as $poly) {
			$p = explode(',', $poly);
			$vertices_x[] = $p[0];
			$vertices_y[] = $p[1];
		}
		$points_polygon = count($vertices_x);
		for ($i = 0, $j = $points_polygon - 1; $i < $points_polygon; $j = $i++) {
			if ((($vertices_y[$i] > $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$i]) * ($latitude_y - $vertices_y[$i]) / ($vertices_y[$j] - $vertices_y[$i]) + $vertices_x[$i]))) $c = !$c;
		}
		return $c;
	}
}
if (!function_exists('isActive')) {
	function isActive(Controller $instance, object $item) {
		$table = $instance->model()->_table;
		$key = $instance->model()->_key;
		if (FwConnection::conn()->query("select * from `tblActiveList` where `table_name` = '{$table}' and `item_id` = '{$item->$key}'")->fetchObject()) {
			return true;
		}
		return false;
	}
}
if (!function_exists('importSql')) {
	function importSql($filePath) {
		$conn = FwConnection::conn();
		$tmpLine = '';
		$lines = file($filePath);
		$i = 0;
		foreach ($lines as $line) {
			if (substr($line, 0, 2) == '--' || $line == '') continue;
			$i++;
			$tmpLine .= $line;
			if (substr(trim($line), -1, 1) == ';') {
				$conn->query($tmpLine);
				$tmpLine = '';
			}
		}
		return $i > 0;
	}
}
if (!function_exists('array_count_values_of')) {
	function array_count_values_of($value, $array) {
		$counts = array_count_values($array);
		return $counts[$value];
	}
}
if (!function_exists('CountDimensions')) {
	function CountDimensions($array) {
		if (is_array(reset($array))) {
			$return = CountDimensions(reset($array)) + 1;
		} else {
			$return = 1;
		}
		return $return;
	}
}
if (!function_exists('GoToUrl')) {
	function GoToUrl(string $url) {
		foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'views/')), '/\.php$/') as $phpFile) {
			$fileName = $phpFile->getFileName();
			$views[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
			$allFiles[] = (true ? str_replace('.php', '', $fileName) : $fileName);
		}
		foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'controllers/')), '/\.php$/') as $phpFile) {
			$controllers[] = (true ? str_replace('.php', '', str_replace(__SOURCE__, '', $phpFile->getRealPath())) : str_replace(__SOURCE__, '', $phpFile->getRealPath()));
		}
		$allFiles = json_encode($allFiles);
		$views = json_encode($views);
		$controllers = json_encode($controllers);
		return "GoToUrl('$url',$allFiles , $views, $controllers)";
	}
}
if (!function_exists('delete_all_between')) {
	function delete_all_between($beginning, $end, $string) {
		$beginningPos = strpos($string, $beginning);
		$endPos = strpos($string, $end);
		if ($beginningPos === false || $endPos === false) {
			return $string;
		}
		$textToDelete = substr($string, $beginningPos, ($endPos + strlen($end)) - $beginningPos);
		return delete_all_between($beginning, $end, str_replace($textToDelete, '', $string));
	}
}
if (!function_exists('showImage')) {
	function showImage($path, $alt = 'تصویر', $width = 150, $height = 150) {
		if (file_exists($path)) {
			return '<img alt="' . $alt . '" src="src/' . $path . '" width="' . $width . ' height="' . $height . ' ">';
		} else {
			foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'images/')), "/$path/") as $file) {
				return '<img alt="' . $alt . '" src="src/' . str_replace(__SOURCE__, '', $file->getRealPath()) . '" width="' . $width . ' height="' . $height . ' ">';
			}
		}
	}
}
if (!function_exists('showSvg')) {
	function showSvg($path, $alt = 'تصویر', $width = 150, $height = 150) {
		foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'images/')), "/$path/") as $file) {
			if (strpos($file->getFileName(), 'svg') !== false) {
				return file_get_contents($file->getRealPath());
			}
		}
		return NULL;
	}
}
if (!function_exists('navItem')) {
	function navItem($name = 'لینک', $link = 'undefined.php', $icon = 'fa fa-circle', int $padding_right = 2, $hasArrow = false, $show = true) {
		if ($show) {
			return '<li class="nav-item pr-' . $padding_right . '">
                <a rel="' . $link . '" class="nav-link ajax">
                    <i class="nav-icon ' . $icon . '"></i>
                    <p>
                        ' . $name . '
                        ' . ($hasArrow ? '<i class="right fa fa-angle-left"></i>' : '') . '
                    </p>
                </a>
            </li>';
		} else
			return NULL;
	}
}
if (!function_exists('navItemHasTreeView')) {
	function navItemHasTreeView(string $name = 'undefined.php', string $icon = 'fa fa-stack-exchange', string $children = '', $padding_right = 0, $show = true) {
		if ($show) {
			return '<li class="nav-item has-treeview pr-' . $padding_right . '">
        <a href="#" class="nav-link">
            <i class="nav-icon ' . $icon . '"></i>
            <p>
                ' . $name . '
                <i class="right fa fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            ' . $children . '
        </ul>
    </li>';
		} else
			return NULL;
	}
}
if (!function_exists('toStr')) {
	function toStr($arg) {
		if (is_array($arg) || is_object($arg)) {
			$arg = (array)$arg;
			foreach ($arg as $key => $value) {
				$arg[$key] = toStr($value);
			}
		} elseif (is_string($arg)) {
			$arg = new Str($arg);
		}
		return $arg;
	}
}
if (!function_exists('deStr')) {
	function deStr($arg) {
		if (is_array($arg) or is_object($arg)) {
			$arg = (array)$arg;
			foreach ($arg as $key => $value) {
				$value = deStr($value);
				$arg[$key] = $value;
			}
		} elseif ($arg instanceof Str) {
			$arg = $arg->getValue();
		}
		return $arg;
	}
}
if (!function_exists('is_json')) {
	function is_json($string, $return_data = false, $assoc = false) {
		if (!is_string($string)) return false;
		$data = json_decode($string, $assoc);
		return (json_last_error() == JSON_ERROR_NONE) ? is_array($data) || is_object($data) ? ($return_data ? $data : true) : false : false;
	}
}
if (!function_exists('removeAfter')) {
	function removeAfter($string, $character) {
		return substr($string, 0, strpos($string, $character));
	}
}
if (!function_exists('showErrorMsg')) {
	function showErrorMsg($name, $type) {
		return '<div class="alert alert-danger  alert-dismissible mrt20">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					<h5><i class="icon fa fa-ban"></i> ' . $type . ' ' . $name . ' با خطا مواجه شد!</h5>
					<p>لطفا مجددا تلاش کنید. در صورت تکرار خطا با مدیر سیستم تماس بگیرید</p>
					<br>
				  </div>';
	}
}
if (!function_exists('showResult')) {
	function showResult($method, $name, $type) {
		if ($method) {
			return showSuccessMsg($name, $type);
		} else {
			return showErrorMsg($name, $type);
		}
	}
}
if (!function_exists('cs_decode')) {
	function cs_decode($string) {
		return explode(',', $string);
	}
}
if (!function_exists('cs_encode')) {
	function cs_encode($array) {
		return implode(',', $array);
	}
}
if (!function_exists('MobileFormat')) {
	function MobileFormat($mobile) {
		$mobile = substr_replace(substr_replace(substr_replace(substr_replace($mobile, " ", 9, 0), " ", 7, 0), ") ", 4, 0), "(", 0, 0);
		return $mobile;
	}
}
if (!function_exists('TelFormat')) {
	function TelFormat($tel) {
		$tel = substr_replace(substr_replace(substr_replace(substr_replace(substr_replace($tel, " ", 9, 0), " ", 7, 0), " ", 5, 0), ") ", 3, 0), "(", 0, 0);
		return $tel;
	}
}
if (!function_exists('CorrectMobile')) {
	function CorrectMobile($mobile) {
		$mobile = preg_replace('/[^0-9]/', '', $mobile);
		return $mobile;
	}
}
if (!function_exists('CallAPI')) {
	function CallAPI($method, $url, $data = false) {
		$curl = curl_init();
		$method = strtoupper($method);
		switch ($method) {
			case "POST":
				curl_setopt($curl, CURLOPT_POST, 1);
				if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "REQUEST":
				curl_setopt($curl, CURLOPT_POSTFIELDS, 1);
				if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
				break;
			case "PUT":
				curl_setopt($curl, CURLOPT_PUT, 1);
				break;
			default:
				if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
		}
		curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($curl, CURLOPT_USERPWD, "username:password");
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}
}
if (!function_exists('checkAll')) {
	function checkAll(array $array, bool $csrfValidate = false, $encodeChildren = true) {
		if ($csrfValidate) {
			$array = csrf_validate($array);
			if ($array == false) return false;
		}
		$array = cleanMe($array);
		foreach ($array as $key => $value) {
			$key1 = strtolower($key);
			if (strpos($key1, 'mobile') !== false) {
				$array[$key] = CorrectMobile($value);
			}
			if (strpos($key1, 'telephone') !== false) {
				$array[$key] = CorrectMobile($value);
			}
			if ($key1 == 'pass' or strpos($key1, 'password') !== false) {
				if ($value != '') {
					$array[$key] = sha1(md5($value));
				} else {
					unset($array[$key]);
				}
			}
			if ($encodeChildren) {
				if ($key == 'checkImage') {
					unset($array[$key]);
				} elseif (is_array($value) || is_object($value)) {
					$array[$key] = json_encode($value);
				}
			}
			if (strpos($key1, 'date') !== false) {
				$array[$key] = persianStrToTime($value);
			}
			if ($key1 == "birthday") {
				$array[$key] = persianStrToTime($value);
			}
			if ($key == 'checkImage') {
				unset($array[$key]);
			}
		}
		return $array;
	}
}
if (!function_exists('cleanMe')) {
	function cleanMe($string) {
		if (is_array($string)) {
			$arr = [];
			foreach ($string as $key => $str) {
				$arr[$key] = cleanme($str);
			}
			return $arr;
		} else {
			return htmlspecialchars($string);
		}
	}
}
if (!function_exists('character_limiter')) {
	function character_limiter($str, $n = 500, $end_char = '&#8230;') {
		if (strlen($str) < $n) {
			return $str;
		}
		$str = preg_replace("/\s+/", ' ', str_replace(["\r\n", "\r", "\n"], ' ', $str));
		if (strlen($str) <= $n) {
			return $str;
		}
		$out = "";
		foreach (explode(' ', trim($str)) as $val) {
			$out .= $val . ' ';
			if (strlen($out) >= $n) {
				$out = trim($out);
				return (strlen($out) == strlen($str)) ? $out : $out . $end_char;
			}
		}
		return NULL;
	}
}
if (!function_exists('generateRandomString')) {
	function generateRandomString($length = 5, $onlyNumbers = false) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		if ($onlyNumbers == true) {
			$characters = '0123456789';
		}
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
if (!function_exists('passwordGenerator')) {
	function passwordGenerator() {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$^%&*';
		$charactersLength = strlen($characters);
		$randomString = '';
		while (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$^%&*-]).{12,}$/', $randomString)) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
if (!function_exists('upload')) {
	function upload($file, $path, $customName = '') {
		$exploded = explode(".", $file['name']);
		$fileName = $customName . time() . "." . end($exploded);
		$path = $path . $fileName;
		if (move_uploaded_file($file['tmp_name'], $path)) {
			return $fileName;
		}
		return false;
	}
}
if (!function_exists('uploadImage')) {
	function uploadImage($file, $checkImage, $path, bool $resize = false, string $extraName = '') {
		$target_dir = endsWith($path, '/') ? $path : $path . '/';
		$exploded = explode(".", $file['name']);
		$ext = end($exploded);
		$fileName = $extraName . time() . "." . $ext;
		$target_file = $target_dir . $fileName;
		if (move_uploaded_file($file['tmp_name'], $target_file)) {
			return $fileName;
		}
		return false;
	}
}
if (!function_exists('get_func_argNames')) {
	function get_func_argNames($funcName) {
		$f = new ReflectionFunction($funcName);
		$result = [];
		foreach ($f->getParameters() as $param) {
			$result[] = $param->name;
		}
		return $result;
	}
}
if (!function_exists('get_method_argNames')) {
	function get_method_argNames($class, $funcName) {
		$f = new ReflectionMethod($class, $funcName);
		$result = [];
		foreach ($f->getParameters() as $param) {
			$result[] = $param->name;
		}
		return $result;
	}
}
if (!function_exists('is_odd')) {
	function is_odd($number) {
		if (!is_numeric($number)) {
			throw new Error('Number input is not numeric');
		} else {
			if ($number % 2 == 0) {
				return true;
			} else {
				return false;
			}
		}
	}
}
if (!function_exists('is_even')) {
	function is_even($number) {
		if (!is_numeric($number)) {
			throw new Error('Number input is not numeric');
		} else {
			if ($number % 2 == 0) {
				return false;
			} else {
				return true;
			}
		}
	}
}
if (!function_exists('checkImage')) {
	function checkImage($array) {
		if (is_array($array['checkImage'])) {
			return $array['checkImage'];
		}
		return false;
	}
}
if (!function_exists('jsonEncode')) {
	function jsonEncode($generator) {
		$output = [];
		foreach ($generator as $key => $item) {
			$output[$key] = $item;
		}
		$output = deStr($output);
		return json_encode($output);
	}
}
if (!function_exists('controllerType')) {
	function controllerType($type = 'add') {
		return hiddenInput($type);
	}
}
if (!function_exists('fa_to_en')) {
	function fa_to_en($number) {
		if (empty($number)) return '0';
		$en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
		$fa = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
		return str_replace($fa, $en, $number);
	}
}
if (!function_exists('en_to_fa')) {
	function en_to_fa($number) {
		if (empty($number)) return '۰';
		$en = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
		$fa = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
		return str_replace($en, $fa, $number);
	}
}
if (!function_exists('optOfArray')) {
	function optOfArray($array, string $key = '', string $name = '', bool $isJson = false, array $data = [], bool $bind = true, bool $emptyOpt = true) {
		$res = '';
		if ($emptyOpt === true) $res = '<option value="" selected disabled>لطفا یک مورد را انتخاب کنید</option>';
		foreach (($isJson ? json_decode($array) : $array) as $keyOfArray => $object) {
			$attrList = '';
			$object = (object)$object;
			foreach ($data as $index => $value) {
				if ($bind) {
					$attrList .= "data-$index=\'{$object->$value}\'";
				} else {
					$attrList .= "data-$index='{$object->$value}'";
				}
			}
			$res .= '<option ' . $attrList . ' value="' . $object->$key . '">' . $object->$name . '</option>';
		}
		return $res;
	}
}
if (!function_exists('UniqueOfClass')) {
	function UniqueOfClass($class, $uniqueField, $strToUpper = false, $length = 7, $onlyNumbers = false, $strToLower = false) {
		
		$table = $class->_table;
		do {
			$resNum = generateRandomString($length, $onlyNumbers);
			$search = FwConnection::conn()->query("select * from $table where `$uniqueField` = '$resNum'");
			if ($search->rowCount() < 1) {
				break;
			}
		} while (true);
		if ($strToUpper === true) return strtoupper($resNum); elseif ($strToLower === true) return strtolower($resNum);
		else
			return $resNum;
	}
}
if (!function_exists('checkBoxCheck')) {
	function checkBoxCheck($condition) {
		return $condition ? 'checked' : '';
	}
}
if (!function_exists('selectChecked')) {
	function selectChecked($condition) {
		return $condition ? ' selected ' : '';
	}
}
if (!function_exists('selectByClass')) {
	function selectByClass($class, string $name = 'defaultNameForName', $keyValue = '0', bool $emptyOpt = true, $secName = false, string $Condition_where = '', $isTheKeyArray = false, $join_class = false, string $display_name = '', string $displaNameSplitor = ' - ', $foreignKey = false) : string {
		if ($emptyOpt == true) {
			$options = '<option value="" selected disabled>لطفا یک مورد را انتخاب کنید</option>';
		} else {
			$options = '';
		}
		$key = $class->_key;
		$table = $class->_table;
		$colName = FwConnection::conn()->query("SELECT `column_name`
FROM   `information_schema`.`columns`
WHERE  `table_schema`=DATABASE()  and COLUMN_KEY != 'PRI'
       AND `table_name`='$table'")->fetchObject()->column_name;
		$name = $name == 'defaultNameForName' ? $colName : $name;
		if (strlen($Condition_where) > 0) {
			$res = $class->getAllConditioned((string)$Condition_where);
		} else {
			$res = $class->getAll();
		}
		$controller = "\controller\\" . end(explode('\\', get_class($class)));
		foreach ($res as $item) {
//            if (isActive(new $controller(),$item)) {
			$item = (object)$item;
			$options .= '<option ' . selectChecked(($isTheKeyArray ? (in_array($item->$key, (array)$keyValue)) : ($item->$key == $keyValue))) . '  value="' . $item->$key . '"> ' . $item->$name . " " . ($secName ? " - " . $item->$secName : '') . ($join_class ? $displaNameSplitor . join_class($join_class, (!$foreignKey ? $item->{$join_class->_key} : $item->$foreignKey), $display_name) : '') . '</option>';
//            }
		}
		return $options;
	}
}
if (!function_exists('join_class')) {
	function join_class($class, $keyValue, $displayName = false) {
		$tableName = $class->_table;
		$key = $class->_key;
		$res = ($displayName ? FwConnection::conn()->query("select * from " . $tableName . " where `$key` = '$keyValue'")->fetchObject()->$displayName : FwConnection::conn()->query("select * from " . $tableName . " where `$key` = '$keyValue'")->fetchObject());
		if (!$res) {
			$res = 'تعریف نشده';
		}
		return $res;
	}
}
if (!function_exists('persianStrToTime')) {
	function persianStrToTime($string) {
		if (is_array($string)) {
			$arr = [];
			foreach ($string as $key => $str) {
				$arr[$key] = persianStrToTime($str);
			}
			return $arr;
		} else {
			if (!isValidTimeStamp($string)) {
				$MonthDayNum = 1;
				$MonthNumber = 1;
				$Minute = 0;
				$Hour = 0;
				$Year = 1399;
				$String = str_replace("ب ظ", "", $string);
				$String = str_replace("ق ظ", "", $String);
				$MonthDays = [
					0  => '۰',
					1  => '۱',
					2  => '۲',
					3  => '۳',
					4  => '۴',
					5  => '۵',
					6  => '۶',
					7  => '۷',
					8  => '۸',
					9  => '۹',
					10 => '۱۰',
					11 => '۱۱',
					12 => '۱۲',
					13 => '۱۳',
					14 => '۱۴',
					15 => '۱۵',
					16 => '۱۶',
					17 => '۱۷',
					18 => '۱۸',
					19 => '۱۹',
					20 => '۲۰',
					21 => '۲۱',
					22 => '۲۲',
					23 => '۲۳',
					24 => '۲۴',
					25 => '۲۵',
					26 => '۲۶',
					27 => '۲۷',
					28 => '۲۸',
					29 => '۲۹',
					30 => '۳۰',
					31 => '۳۱',
				];
				$weekDays = ['شنبه', 'یکشنبه', 'دوشنبه', 'سه شنبه', 'چهار شنبه', 'پنج‌شنبه', 'جمعه'];
				$arrayOfMonths = [
					1  => 'فروردین',
					2  => 'اردیبهشت',
					3  => 'خرداد',
					4  => 'تیر',
					5  => 'مرداد',
					6  => 'شهریور',
					7  => 'مهر',
					8  => 'آبان',
					9  => 'آذر',
					10 => 'دی',
					11 => 'بهمن',
					12 => 'اسفند',
				];
				foreach ($arrayOfMonths as $monthNum => $month) {
					if (strpos($String, $month)) {
						$MonthNumber = $monthNum;
						$String = str_replace($month, "", $String);
					}
				}
				$hasWeekDay = false;
				foreach ($weekDays as $weekDay) {
					if (strpos($string, $weekDay)) {
						$hasWeekDay = true;
					}
				}
				if ($hasWeekDay == true) {
					$String = str_replace($weekDays[1], "", $String);
					$String = str_replace($weekDays[2], "", $String);
					$String = str_replace($weekDays[3], "", $String);
					$String = str_replace($weekDays[4], "", $String);
					$String = str_replace($weekDays[5], "", $String);
					$String = str_replace($weekDays[6], "", $String);
					$String = str_replace($weekDays[0], "", $String);
				}
				foreach ($MonthDays as $monthDay => $day) {
					$String = str_replace($day, $monthDay, $String);
				}
				$arrayOFNums = [
					1 => "01",
					2 => "02",
					3 => "03",
					4 => "04",
					5 => "05",
					6 => "06",
					7 => "07",
					8 => "08",
					9 => "09",
				];
				$demo = [];
				foreach ($arrayOFNums as $num => $OFNum) {
//         array_push($demo,strpos($String,$OFNum));
					if (strpos($String, $OFNum) != false) {
						$String = str_replace(" " . $OFNum . " ", $num, $String);
						$MonthDayNum = $num;
					} else {
						foreach ($MonthDays as $monthDayNum => $monthDay) {
							$monthDayNum = (string)$monthDayNum;
							$String = str_replace($monthDay, $monthDayNum, $String);
							if (strpos($String, " " . $monthDayNum . " ") !== false) {
								$String = str_replace(" " . $monthDayNum . " ", "", $String);
								$MonthDayNum = $monthDayNum;
							}
						}
					}
				}
				$MonthDayNum = (int)$MonthDayNum;
				for ($i = 1000; $i <= 1500; $i++) {
					$i = (string)$i;
					if (strpos($String, $i) != false) {
						$String = str_replace($i, '', $String);
						$Year = $i;
					}
				}
				if (strpos($String, ':')) {
					$dist = str_replace(" ", "", $String);
					$Minute = end(explode(":", $dist));
					settype($Minute, 'integer');
					$Hour = explode(":", $dist)[0];
					settype($Hour, 'integer');
				}
				$gregTime = jalali_to_gregorian($Year, $MonthNumber, $MonthDayNum);
				return mktime($Hour, $Minute, 0, $gregTime[1], $gregTime[2], $gregTime[0]);
			} else {
				return $string;
			}
		}
	}
}
if (!function_exists('isValidTimeStamp')) {
	function isValidTimeStamp($timestamp) {
		return ((string)(int)$timestamp === $timestamp) && ($timestamp <= PHP_INT_MAX) && ($timestamp >= ~PHP_INT_MAX);
	}
}
if (!function_exists('jalali_to_gregorian')) {
	function jalali_to_gregorian($j_y, $j_m, $j_d) {
		
		$g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		$j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
		$jy = $j_y - 979;
		$jm = $j_m - 1;
		$jd = $j_d - 1;
		$j_day_no = 365 * $jy + div($jy, 33) * 8 + div($jy % 33 + 3, 4);
		for ($i = 0; $i < $jm; ++$i)
			$j_day_no += $j_days_in_month[$i];
		$j_day_no += $jd;
		$g_day_no = $j_day_no + 79;
		$gy = 1600 + 400 * div($g_day_no, 146097); /* 146097 = 365*400 + 400/4 - 400/100 + 400/400 */
		$g_day_no = $g_day_no % 146097;
		$leap = true;
		if ($g_day_no >= 36525) /* 36525 = 365*100 + 100/4 */ {
			
			$g_day_no--;
			$gy += 100 * div($g_day_no, 36524); /* 36524 = 365*100 + 100/4 - 100/100 */
			$g_day_no = $g_day_no % 36524;
			if ($g_day_no >= 365)
				$g_day_no++;
			else
				
				$leap = false;
		}
		$gy += 4 * div($g_day_no, 1461); /* 1461 = 365*4 + 4/4 */
		$g_day_no %= 1461;
		if ($g_day_no >= 366) {
			
			$leap = false;
			$g_day_no--;
			$gy += div($g_day_no, 365);
			$g_day_no = $g_day_no % 365;
		}
		for ($i = 0; $g_day_no >= $g_days_in_month[$i] + ($i == 1 && $leap); $i++)
			$g_day_no -= $g_days_in_month[$i] + ($i == 1 && $leap);
		$gm = $i + 1;
		$gd = $g_day_no + 1;
		return [$gy, $gm, $gd];
	}
}
if (!function_exists('div')) {
	function div($a, $b) {
		return (int)($a / $b);
	}
}
if (!function_exists('jmaketime')) {
	function jmaketime($hour = "", $minute = "", $second = "", $jmonth = "", $jday = "", $jyear = "") {
		
		if (!$hour && !$minute && !$second && !$jmonth && !$jmonth && !$jday && !$jyear)
			return time();
		[$year, $month, $day] = jalali_to_gregorian($jyear, $jmonth, $jday);
		return mktime($hour, $minute, $second, $month, $day, $year);
	}
}
if (!function_exists('jcheckdate')) {
	function jcheckdate($month, $day, $year) {
		
		$j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
		if ($month <= 12 && $month > 0) {
			
			if ($j_days_in_month[$month - 1] >= $day && $day > 0)
				return 1;
			if (is_kabise($year))
				echo "Asdsd";
			if (is_kabise($year) && $j_days_in_month[$month - 1] == 31)
				return 1;
		}
		return 0;
	}
}
if (!function_exists('is_kabise')) {
	function is_kabise($year) {
		
		if ($year % 4 == 0 && $year % 100 != 0)
			return true;
		return false;
	}
}
if (!function_exists('jgetdate')) {
	function jgetdate($timestamp = "") {
		
		if ($timestamp == "")
			$timestamp = time();
		return [
			0 => $timestamp,
			"seconds" => jdate("s", $timestamp),
			"minutes" => jdate("i", $timestamp),
			"hours" => jdate("G", $timestamp),
			"mday" => jdate("j", $timestamp),
			"wday" => jdate("w", $timestamp),
			"mon" => jdate("n", $timestamp),
			"year" => jdate("Y", $timestamp),
			"yday" => days_of_year(jdate("m", $timestamp), jdate("d", $timestamp), jdate("Y", $timestamp)),
			"weekday" => jdate("l", $timestamp),
			"month" => jdate("F", $timestamp),
		];
	}
}
if (!function_exists('jdate')) {
	function jdate($type, $maket = "now") {
		if (!is_numeric($maket)) {
			$maket = time();
		}
		$transnumber = 0;
		$TZhours = 0;
		$TZminute = 0;
		$need = "";
		$result1 = "";
		$result = "";
		if ($maket == "now") {
			$year = date("Y");
			$month = date("m");
			$day = date("d");
			[$jyear, $jmonth, $jday] = gregorian_to_jalali($year, $month, $day);
			$maket = mktime(date("H") + $TZhours, date("i") + $TZminute, date("s"), date("m"), date("d"), date("Y"));
		} else {
			$maket += $TZhours * 3600 + $TZminute * 60;
			$date = date("Y-m-d", $maket);
			[$year, $month, $day] = preg_split('/-/', $date);
			[$jyear, $jmonth, $jday] = gregorian_to_jalali($year, $month, $day);
		}
		$need = $maket;
		$year = date("Y", $need);
		$month = date("m", $need);
		$day = date("d", $need);
		$i = 0;
		$subtype = "";
		$subtypetemp = "";
		[$jyear, $jmonth, $jday] = gregorian_to_jalali($year, $month, $day);
		while ($i < strlen($type)) {
			
			$subtype = substr($type, $i, 1);
			if ($subtypetemp == "\\") {
				
				$result .= $subtype;
				$i++;
				continue;
			}
			switch ($subtype) {
				
				case "A":
					$result1 = date("a", $need);
					if ($result1 == "pm") $result .= "&#1576;&#1593;&#1583;&#1575;&#1586;&#1592;&#1607;&#1585;";
					else $result .= "&#1602;&#1576;&#1604;&#8207;&#1575;&#1586;&#1592;&#1607;&#1585;";
					break;
				case "a":
					$result1 = date("a", $need);
					if ($result1 == "pm") $result .= "&#1576;&#46;&#1592;";
					else $result .= "&#1602;&#46;&#1592;";
					break;
				case "d":
					if ($jday < 10) $result1 = "0" . $jday;
					else    $result1 = $jday;
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "D":
					$result1 = date("D", $need);
					if ($result1 == "Thu") $result1 = "&#1662;";
					elseif ($result1 == "Sat") $result1 = "&#1588;";
					elseif ($result1 == "Sun") $result1 = "&#1609;";
					elseif ($result1 == "Mon") $result1 = "&#1583;";
					elseif ($result1 == "Tue") $result1 = "&#1587;";
					elseif ($result1 == "Wed") $result1 = "&#1670;";
					elseif ($result1 == "Thu") $result1 = "&#1662;";
					elseif ($result1 == "Fri") $result1 = "&#1580;";
					$result .= $result1;
					break;
				case"F":
					$result .= monthname($jmonth);
					break;
				case "g":
					$result1 = date("g", $need);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "G":
					$result1 = date("G", $need);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "h":
					$result1 = date("h", $need);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "H":
					$result1 = date("H", $need);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "i":
					$result1 = date("i", $need);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "j":
					$result1 = $jday;
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "l":
					$result1 = date("l", $need);
					if ($result1 == "Saturday") $result1 = "&#1588;&#1606;&#1576;&#1607;";
					elseif ($result1 == "Sunday") $result1 = "&#1610;&#1603;&#1588;&#1606;&#1576;&#1607;";
					elseif ($result1 == "Monday") $result1 = "&#1583;&#1608;&#1588;&#1606;&#1576;&#1607;";
					elseif ($result1 == "Tuesday") $result1 = "&#1587;&#1607;&#32;&#1588;&#1606;&#1576;&#1607;";
					elseif ($result1 == "Wednesday") $result1 = "&#1670;&#1607;&#1575;&#1585;&#1588;&#1606;&#1576;&#1607;";
					elseif ($result1 == "Thursday") $result1 = "&#1662;&#1606;&#1580;&#1588;&#1606;&#1576;&#1607;";
					elseif ($result1 == "Friday") $result1 = "&#1580;&#1605;&#1593;&#1607;";
					$result .= $result1;
					break;
				case "m":
					if ($jmonth < 10) $result1 = "0" . $jmonth;
					else    $result1 = $jmonth;
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "M":
					$result .= short_monthname($jmonth);
					break;
				case "n":
					$result1 = $jmonth;
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "s":
					$result1 = date("s", $need);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "S":
					$result .= "&#1575;&#1605;";
					break;
				case "t":
					$result .= mstart($month, $day, $year);
					break;
				case "w":
					$result1 = date("w", $need);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "y":
					$result1 = substr($jyear, 2, 4);
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "Y":
					$result1 = $jyear;
					if ($transnumber == 1) $result .= Convertnumber2farsi($result1);
					else $result .= $result1;
					break;
				case "U" :
					$result .= time();
					break;
				case "Z" :
					$result .= days_of_year($jmonth, $jday, $jyear);
					break;
				case "L" :
					[$tmp_year, $tmp_month, $tmp_day] = jalali_to_gregorian(13112, 12, 1);
					echo $tmp_day;
					/*if(mstart($tmp_month,$tmp_day,$tmp_year)=="31")

						$result.="1";

					else

						$result.="0";

						*/
					break;
				default:
					$result .= $subtype;
			}
			$subtypetemp = substr($type, $i, 1);
			$i++;
		}
		return $result;
	}
}
if (!function_exists('gregorian_to_jalali')) {
	function gregorian_to_jalali($g_y, $g_m, $g_d) {
		
		$g_days_in_month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
		$j_days_in_month = [31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29];
		$gy = $g_y - 1600;
		$gm = $g_m - 1;
		$gd = $g_d - 1;
		$g_day_no = 365 * $gy + div($gy + 3, 4) - div($gy + 99, 100) + div($gy + 399, 400);
		for ($i = 0; $i < $gm; ++$i)
			$g_day_no += $g_days_in_month[$i];
		if ($gm > 1 && (($gy % 4 == 0 && $gy % 100 != 0) || ($gy % 400 == 0)))
			/* leap and after Feb */
			$g_day_no++;
		$g_day_no += $gd;
		$j_day_no = $g_day_no - 79;
		$j_np = div($j_day_no, 12053); /* 12053 = 365*33 + 32/4 */
		$j_day_no = $j_day_no % 12053;
		$jy = 979 + 33 * $j_np + 4 * div($j_day_no, 1461); /* 1461 = 365*4 + 4/4 */
		$j_day_no %= 1461;
		if ($j_day_no >= 366) {
			
			$jy += div($j_day_no - 1, 365);
			$j_day_no = ($j_day_no - 1) % 365;
		}
		for ($i = 0; $i < 11 && $j_day_no >= $j_days_in_month[$i]; ++$i)
			$j_day_no -= $j_days_in_month[$i];
		$jm = $i + 1;
		$jd = $j_day_no + 1;
		return [$jy, $jm, $jd];
	}
}
if (!function_exists('Convertnumber2farsi')) {
	function Convertnumber2farsi($srting) {
		
		$num0 = "&#1776;";
		$num1 = "&#1777;";
		$num2 = "&#1778;";
		$num3 = "&#1779;";
		$num4 = "&#1780;";
		$num5 = "&#1781;";
		$num6 = "&#1782;";
		$num7 = "&#1783;";
		$num8 = "&#17112;";
		$num9 = "&#1785;";
		$stringtemp = "";
		$len = strlen($srting);
		for ($sub = 0; $sub < $len; $sub++) {
			
			if (substr($srting, $sub, 1) == "0") $stringtemp .= $num0;
			elseif (substr($srting, $sub, 1) == "1") $stringtemp .= $num1;
			elseif (substr($srting, $sub, 1) == "2") $stringtemp .= $num2;
			elseif (substr($srting, $sub, 1) == "3") $stringtemp .= $num3;
			elseif (substr($srting, $sub, 1) == "4") $stringtemp .= $num4;
			elseif (substr($srting, $sub, 1) == "5") $stringtemp .= $num5;
			elseif (substr($srting, $sub, 1) == "6") $stringtemp .= $num6;
			elseif (substr($srting, $sub, 1) == "7") $stringtemp .= $num7;
			elseif (substr($srting, $sub, 1) == "8") $stringtemp .= $num8;
			elseif (substr($srting, $sub, 1) == "9") $stringtemp .= $num9;
			else $stringtemp .= substr($srting, $sub, 1);
		}
		return $stringtemp;
	}
}
if (!function_exists('monthname')) {
	function monthname($month) {
		
		if ($month == "01") return "فروردین";
		if ($month == "02") return "اردیبهشت";
		if ($month == "03") return "خرداد";
		if ($month == "04") return "تیر";
		if ($month == "05") return "مرداد";
		if ($month == "06") return "شهریور";
		if ($month == "07") return "مهر";
		if ($month == "08") return "آبان";
		if ($month == "09") return "آذر";
		if ($month == "10") return "دی";
		if ($month == "11") return "بهمن";
		if ($month == "12") return "اسفند";
	}
}
if (!function_exists('short_monthname')) {
	function short_monthname($month) {
		
		if ($month == "01") return "&#1601;&#1585;&#1608;";
		if ($month == "02") return "&#1575;&#1585;&#1583;";
		if ($month == "03") return "&#1582;&#1585;&#1583;";
		if ($month == "04") return "&#1578;&#1610;&#1585;";
		if ($month == "05") return "&#1605;&#1585;&#1583;";
		if ($month == "06") return "&#1588;&#1607;&#1585;";
		if ($month == "07") return "&#1605;&#1607;&#1585;";
		if ($month == "08") return "&#1570;&#1576;&#1575;";
		if ($month == "09") return "&#1570;&#15112;&#1585;";
		if ($month == "10") return "&#1583;&#1610;";
		if ($month == "11") return "&#1576;&#1607;&#1605;";
		if ($month == "12") return "&#1575;&#1587;&#1601; ";
	}
}
if (!function_exists('mstart')) {
	function mstart($month, $day, $year) {
		
		[$jyear, $jmonth, $jday] = gregorian_to_jalali($year, $month, $day);
		[$year, $month, $day] = jalali_to_gregorian($jyear, $jmonth, "1");
		$timestamp = mktime(0, 0, 0, $month, $day, $year);
		return date("w", $timestamp);
	}
}
if (!function_exists('days_of_year')) {
	function days_of_year($jmonth, $jday, $jyear) {
		
		$year = "";
		$month = "";
		$year = "";
		$result = "";
		if ($jmonth == "01")
			return $jday;
		for ($i = 1; $i < $jmonth || $i == 12; $i++) {
			
			[$year, $month, $day] = jalali_to_gregorian($jyear, $i, "1");
			$result += mstart($month, $day, $year);
		}
		return $result + $jday;
	}
}
if (!function_exists('hiddenInput')) {
	function hiddenInput($value = 'add', $name = 'controller_type', $id = '') {
		if ($id === '') $id = $name;
		return '<input ' . (strlen($id) > 0 ? 'id="' . $id . '"' : '') . ' type="hidden" name="' . $name . '" value="' . $value . '">';
	}
}
if (!function_exists('price_format')) {
	function price_format($price) {
		$price = (is_numeric($price) ? $price : '0');
		$price = (float)$price;
		$price = (is_float($price) ? $price : 0);
		return en_to_fa(number_format($price)) . ' تومان';
	}
}
if (!function_exists('sendSingleSMS')) {
	function sendSingleSMS($phoneNumber, $text) {

		$proxyhost = "";
		$proxyport = "";
		$proxyusername = "";
		$proxypassword = "";
		$client = new nusoap_client('http://tartansms.com/smssendwebserviceforphp.asmx?wsdl', 'wsdl', $proxyhost, $proxyport, $proxyusername, $proxypassword);
		$client->soap_defencoding = 'UTF-8';
		$client->decode_utf8 = false;
		$user = "digchi";
		$pass = "123456";
		$domain = "tartansms";
		$param = [
			'UserName'     => $user,
			'Pass'         => $pass,
			'Domain'       => $domain,
			'SmsText'      => $text,
			'MobileNumber' => $phoneNumber,
			'SenderNumber' => '30006403868611',
			'smsMode'      => 'SaveInPhone',
		];
		$client->call('SendSingleSms', ['parameters' => $param], '', '', false, true);
		if ($client->fault) {
			return false;
		} else {
			// Check for errors
			$err = $client->getError();
			if ($err) {
				return false;
			} else {
				
				// Display the result
				return true;
			}
		}
	}
}
if (!function_exists('sendVerify')) {
    function sendVerify($phoneNumber, array $param, $code = 37) {
        try
        {
            $user = "mbarati";
            $pass = "110591356";


            $client = new SoapClient("http://87.107.121.52/post/send.asmx?wsdl");

            $sendsms_parameters = array(
                'username' => $user,
                'password' => $pass,
                'to' => array($phoneNumber),
                'isflash' => false,
                'udh' => "",
                'recId' => array(0),
                'code' => $code,
                'Parameter' => implode(',',$param)
            );
            return $client->SendSMSVerify($sendsms_parameters);
        }
        catch (SoapFault $ex)
        {
            return  false;
        }

    }
}
if (!function_exists('getIp')) {
	function getIp() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
}
if (!function_exists('getTime')) {
	function getTime($year = -1, $month = -1, $day = -1, $hour = -1, $minute = -1, $second = -1, $time = -1) {
		if ($time == -1) $time = time();
		if ($year == -1) $year = date('Y', $time);
		if ($month == -1) $month = date('m', $time);
		if ($day == -1) $day = date('d', $time);
		if ($hour == -1) $hour = date('H', $time);
		if ($minute == -1) $minute = date('i', $time);
		if ($second == -1) $second = date('s', $time);
		return mktime($hour, $minute, $second, $month, $day, $year);
	}
}
if (!function_exists('get_string_between')) {
	function get_string_between($string, $start, $end) {
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}
}
if (!function_exists('isValidMd5')) {
	function isValidMd5($md5 = '') {
		return preg_match('/^[a-f0-9]{32}$/', $md5);
	}
}
if (!function_exists('array_swap')) {
	function array_swap(array $array) {
		reset($array);
		$array[key($array)] = array_shift($array);
		end($array);
		$v = prev($array);
		$k = key($array);
		$array = [$k => $v] + $array;
		return $array;
	}
}
if (!function_exists('startsWith')) {
	function startsWith($haystack, $needle) {
		$length = strlen($needle);
		return (substr($haystack, 0, $length) === $needle);
	}
}
if (!function_exists('endsWith')) {
	function endsWith($haystack, $needle) {
		$length = strlen($needle);
		if ($length == 0) {
			return true;
		}
		return (substr($haystack, -$length) === $needle);
	}
}
if (!function_exists('arrayHasSubString')) {
	function arrayHasSubString(array $array, string $subString) {
		foreach ($array as $value) {
			if (strpos($value, $subString) !== false) {
				return true;
			}
		}
		return false;
	}
}
if (!function_exists('arrayHasSubStringFromArray')) {
	function arrayHasSubStringFromArray(array $array, array $ArrayOfSubStrings) {
		foreach ($array as $value) {
			foreach ($ArrayOfSubStrings as $subString) {
				if ($value === $subString) {
					return true;
				}
			}
		}
		return false;
	}
}
if (!function_exists('getClassFromFile')) {
	function getClassFromFile($file) {
		$file = endsWith($file, '.php') ? $file : $file . '.php';
		if (file_exists($file) and !is_dir($file)) {
			$fp = fopen($file, 'r');
			$class = $buffer = '';
			$i = 0;
			while (!$class) {
				if (feof($fp)) break;
				$buffer .= fread($fp, 512);
				$tokens = token_get_all($buffer);
				if (strpos($buffer, '{') === false) continue;
				for (; $i < count($tokens); $i++) {
					if ($tokens[$i][0] === T_CLASS) {
						for ($j = $i + 1; $j < count($tokens); $j++) {
							if ($tokens[$j] === '{') {
								$class = $tokens[$i + 2][1];
								return $class;
							}
						}
					}
				}
			}
		}
	}
}
if (!function_exists('calculatePermutations')) {
	function calculatePermutations($text) {
		
		$permutations = [];
		$chars = str_split($text);
		for ($i = 1; $i < strlen($text) ** 2; $i++) {
			
			for ($j = 0; $j < strlen($text); $j++) {
				
				$permutations[$i][] = (isBitSet($i, $j)) ? strtoupper($chars[$j]) : $chars[$j];
			}
			$permutations[$i] = implode('', ($permutations[$i]));
		}
		return $permutations;
	}
}
if (!function_exists('isBitSet')) {
	function isBitSet($n, $offset) {
		return ($n >> $offset & 1) != 0;
	}
}
