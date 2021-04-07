<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
@session_start();
define('__BASE_DIR__', substr(__DIR__, 0, strpos(__DIR__, 'src') - 1) . DIRECTORY_SEPARATOR);
define('__SOURCE__', substr(__DIR__, 0, strpos(__DIR__, 'src') + 3) . DIRECTORY_SEPARATOR);
if (!isset($DONT_INCLUDE) or $DONT_INCLUDE === false) {
    include __SOURCE__ . 'conf' . DIRECTORY_SEPARATOR . 'conf.php';
    include __SOURCE__ . 'conf' . DIRECTORY_SEPARATOR . 'connection.php';
    include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'helpers.php';
    include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'numToWord.php';

    include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'fw.php';
    include __SOURCE__ . 'helpers' . DIRECTORY_SEPARATOR . 'security.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataTypes/String.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Php/Session.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataTypes/Arr.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataTypes/Boolean.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Json/JsonException.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Json/JsonHelper.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Json/Json.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Collections/autoload.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'ORM/autoload.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/ErrorHandling/MigrationException.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/TableName.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Schema/Migration.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Types.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Defaults.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Col.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/Blueprint.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'ControllerException.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Controllers/Controller.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Controllers/ControllerScheme.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Controllers/ControllersPagination.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Views/View.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Pages/Forms/loader.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Pages/FontAwesome/FontAwesome.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'SideBarClasses/HasTreeViewItemExtendsLi.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'SideBarClasses/MenuItem.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'SideBarClasses/SideBar.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Router/RouterException.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Router/RouterCommand.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Router/RouterRequest.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Router/Middleware.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Router.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Auth/loader.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Dom/vendor/autoload.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Js/Js.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'ErrorHandling/src/ErrorHandler.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Api/ApiInterface.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'CodeGenerator'.DIRECTORY_SEPARATOR.'autoload.php';
    include __SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Dumper' . DIRECTORY_SEPARATOR . 'MysqlDumper.php';
	
	foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist/php/Payment/Classes/')), '/\.php$/') as $phpFile) {
		include $phpFile->getRealPath();
	}
	foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist/php/Payment/Interfaces/')), '/\.php$/') as $phpFile) {
		include $phpFile->getRealPath();
	}
	if (is_dir(__SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Custom/')) {
		foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Custom/')), '/\.php$/') as $phpFile) {
			include $phpFile->getRealPath();
		}
	}
	spl_autoload_register(function ($name) {
		$str = new Str($name);
		$path = '';
		switch ($str) {
			case $str->includes('controller\\'):
				$path = 'controllers';
				
				$str = $str->explode('\\');
				end($str);
				break;
			case $str->includes('model\\Entity'):
				$path = 'entities';
				$str->replace("Entity",'');
				$str = $str->explode('\\');
				$str[sizeof($str) - 1] = end($str).'.entity';
				end($str);
				break;
			case $str->includes('model\\'):
				$path = 'models';
				$str = $str->explode('\\');
				end($str);
				break;
			case $str->includes('view\\'):
				$path = 'views';
				$str = $str->explode('\\');
				end($str);
				break;
			case $str->includes('FwAuthSystem\Role\\'):
				$path = 'conf/Roles';
				$str = $str->explode('\\');
				end($str);
				break;
		}
		
		foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . $path . '/')), '/' . current($str) . '.php$/') as $phpFile) {
			include $phpFile->getRealPath();
		}
	});

}
