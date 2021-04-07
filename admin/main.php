<?
ini_set('session.save_path', '/tmp');
ini_set('error_reporting', E_ALL & ~E_NOTICE);
ini_set('display_errors', E_ALL & ~E_NOTICE);

use FwAuthSystem\Main\Auth;
use FwRoutingSystem\Router;
use FwAuthSystem\Main\UserObject;
use FwAuthSystem\Utils\AuthConfig;
use DATABASE\ORM\QueryBuilder\QueryBuilder\Db;

include 'src/autoload.php';
$Router = new Router();
define('__HOST__', FwConfig::HOST());
$Router->get('/$|/index', function () {
	include 'src/index.php';
});
$Router->group('/', function (Router $router) {
	$router->any('/js/:all', function ($param) {
		header("Content-Type: text/javascript");
		$param = strtok($param, "?");
		$text = file_get_contents(__SOURCE__ . 'views/' . $param);
		$params = explode('/', $param);
		$last = end($params);
		array_pop($params);
		$last = strtok($last, '.');
		$path = "controllers/" . implode('/', $params) . '/' . $last;
		$pos = strpos($text, 'import');
		$newText = substr($text, $pos, strlen($text));
		echo substr_replace($text, ";\nconst CurrentPathForController = '{$path}'\n", stripos($newText, ';'), 0);
	});
	$router->any('/getPaginateInfo', function () {
		var_dump($_SERVER['HTTP_REFERER']);
	});
	$router->any('/modules/:string/:any?/:any?/:any?/:any?/:any?:any?', function () {
		$str = implode(DIRECTORY_SEPARATOR, func_get_args());
		$host = $_SERVER['HTTP_HOST'];
		$referer = urldecode($_SERVER['HTTP_REFERER']);
		$referer = str_replace("http://", "", str_replace($host, "", str_replace("https://", "", $referer)));
		$referer = str_replace("/src/", "", $referer);
		$referer = str_replace("src/", "", $referer);
		$referer = strtok($referer, '?');
//		var_dump($referer);
//		if (file_exists(__SOURCE__ . $referer)) {
		header("Content-Type: text/javascript");
		if (!str($str)->endsWith('.js')) $str .= '.js';
		if (file_exists(__SOURCE__ . 'modules/' . $str)) {
			include __SOURCE__ . 'modules/' . $str;
		} else {
			include __SOURCE__ . 'modules/notFoundModule.js';
		}
//		} else {
//			return "request failed";
//		}
	});
	$router->any('/conf/Activate', function () {
		$db = Db::table('tblActiveList');
		if ($_POST['action'] == 'activate') {
			if (!$db->where(['item_id' => $_POST['item_id'], 'table_name' => $_POST['table_name']])->get()->first()) {
				$res = $db->insert([
					'item_id'    => $_POST['item_id'],
					'table_name' => $_POST['table_name'],
					'date'       => time(),
					'user_id'    => UserObject::instance()->getUserId(),
				]);
				if ($res) {
					return 1;
				} else {
					return 0;
				}
			} else {
				return 500;
			}
		} else {
			if ($db->where(['item_id' => $_POST['item_id'], 'table_name' => $_POST['table_name']])->get()->first()) {
				$res = $db->where(['item_id' => $_POST['item_id'], 'table_name' => $_POST['table_name']])->delete();
				if ($res) {
					return 2;
				} else {
					return 0;
				}
			} else {
				return 404;
			}
		}
	});
	$router->any('/CheckSession', function () {
		include 'src/Actions/CheckSession.php';
	});
	$router->any('controllers/.{1,}/:string?', ['before' => new AuthMiddleware()], function () {
		$request_url = $_SERVER['REQUEST_URI'];
		if (strpos($request_url, '?')) {
			$request_url = explode('?', $request_url)[0];
		}
		$remove = trim(str_replace($_SERVER['HTTP_HOST'], '', __HOST__));
		$request_url = str_replace($remove, '', $request_url);
		if (file_exists(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php') and !is_dir(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php')) {
			$last = explode('/', $request_url)[sizeof(explode('/', $request_url)) - 1];
			$class = "\controller\\$last";
			$class = new $class();
			return $class->do();
		}
	});
	$router->any('views/.{1,}/:string?', ['before' => new AuthMiddleware()], function () {
		$request_url = $_SERVER['REQUEST_URI'];
		if (strpos($request_url, '?')) {
			$request_url = explode('?', $request_url)[0];
		}
		$remove = trim(str_replace($_SERVER['HTTP_HOST'], '', __HOST__));
		$request_url = str_replace($remove, '', $request_url);
		if (file_exists(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php') and !is_dir(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php')) {
			include __SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php';
		}
	});
	$router->any('fwTools/controller/.{1,}/:string?', ['before' => new AuthMiddleware()], function () {
		$request_url = $_SERVER['REQUEST_URI'];
		if (strpos($request_url, '?')) {
			$request_url = explode('?', $request_url)[0];
		}
		$remove = trim(str_replace($_SERVER['HTTP_HOST'], '', __HOST__));
		$request_url = str_replace($remove, '', $request_url);
		if (file_exists(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php') and !is_dir(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php')) {
			include __SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php';
		}
	});
	$router->any('fwTools/view/.{1,}/:string?', ['before' => new AuthMiddleware()], function () {
		$request_url = $_SERVER['REQUEST_URI'];
		if (strpos($request_url, '?')) {
			$request_url = explode('?', $request_url)[0];
		}
		$remove = trim(str_replace($_SERVER['HTTP_HOST'], '', __HOST__));
		$request_url = str_replace($remove, '', $request_url);
		if (file_exists(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php') and !is_dir(__SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php')) {
			include __SOURCE__ . str_replace('/src/', '', ($request_url)) . '.php';
		}
	});
	$router->any('/[a-zA-Z\d]{1,}/API/:string?/_{s}?', function ($s = '') {
		$arr = explode('_', $s);
		$version = $arr[0];
		$controller_type = $arr[1];
		$request_url = $_SERVER['REQUEST_URI'];
		if (strpos($request_url, '?')) {
			$request_url = explode('?', $request_url)[0];
		}
		$filename = str_replace('src/', '', $request_url);
		$filename = explode('/API', $filename)[0];
		if ($filename[0] === '/') {
			$filename = substr($filename, 1, strlen($filename));
		}
		$arr = explode('/', $filename);
		$filename = end($arr);
		if (class_exists("\controller\\$filename")) {
			$filename = "\controller\\$filename";
			$class = (new $filename());
			$arr = (explode('API', $request_url));
			$controller_type = explode('?', $controller_type)[0];
			if (FwConfig::API_TOKEN() !== 'NOT_SET') {
				$token = get_header('token');
				if (!isset($token)) {
					echo json_encode(['Access Denied!']);
					exit();
				} elseif ($token != FwConfig::API_TOKEN()) {
					$array = is_odd(rand(1, 2)) ? calculatePermutations('wrong token') : calculatePermutations('false token');
					echo json_encode(["message" => $array[rand(0, sizeof($array) - 1)]]);
					exit();
				}
			} else {
				exit('token not set');
			}
			if ($class instanceof Controller and $class->isApi()) {
				$class->Api($controller_type, $version);
			}
		} else {
			return 'Not Found!';
		}
	});
	$router->any('/[a-zA-Z\d]{1,}', ['before' => new AuthMiddleware()], function () {
		
		if (endsWith($_SERVER['REQUEST_URI'], '/')) {
			$arr = str_split($_SERVER['REQUEST_URI']);
			unset($arr[sizeof($arr) - 1]);
			$arr = implode('', $arr);
			header('location: ' . $arr);
		}
		include __SOURCE__ . 'index.php';
	});
});
$Router->any('/sign-out', function () {
	Auth::end();
	header('location: /'
	);
});
$Router->error(function () {
	include 'pages/404.php';
});
$Router->get('/login', function () {
	$Auth = Auth::init(new AuthConfig());
	include 'src/login.php';
});
$Router->post('/login', function () {
	$Auth = Auth::init(new AuthConfig());
	include 'src/login.php';
	$Auth->ProccessOnSubmit();
});
