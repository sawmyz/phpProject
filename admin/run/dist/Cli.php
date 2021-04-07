<?php

namespace fwCli\dist;

use PDO;
use View;
use FwConfig;
use TableDumper;
use RegexIterator;
use ReflectionClass;
use ControllerScheme;
use fwCli\Write\UserCommands;
use RecursiveIteratorIterator;
use RecursiveDirectoryIterator;
use FwMigrationSystem\Main\Migratable;
use CodeGenerator\Classes\ClassEditor;
use FwPagination\Views\ViewPagination;
use FwPagination\Controllers\ControllersPagination;

session_start();
if (!isset($_SESSION['fw']['cli']['__DIR__'])) {
	$_SESSION['fw']['cli']['__DIR__'] = __BASE_DIR__;
	$_SESSION['fw']['cli']['dir'] = str_replace(__BASE_DIR__, '', $_SESSION['fw']['cli']['__DIR__']);
} else {
	$_SESSION['fw']['cli']['__DIR__'] = (endsWith($_SESSION['fw']['cli']['__DIR__'], '/') ? $_SESSION['fw']['cli']['__DIR__'] : $_SESSION['fw']['cli']['__DIR__'] . '/');
}

class Cli {
	private $commands = [];
	private $command;
	
	public function __construct($command) {
		ob_start();
		$this->command = $command;
	}
	
	public function addCommand(UserCommands $command) {
		$className = get_class($command);
		if (strpos($className, '\\') !== false) {
			$arr = explode('\\', $className);
			$class = end($arr);
			$class = str_replace('Command', '', $class);
			$class = strtolower($class);
			$commands = $this->getCommands();
			$commands[$class] = $command;
			$this->setCommands($commands);
		} else {
			$class = strtolower($className);
			$commands = $this->getCommands();
			$commands[$class] = $command;
			$this->setCommands($commands);
		}
	}
	
	/**
	 * @return array
	 */
	private function getCommands() : array {
		return $this->commands;
	}
	
	/**
	 * @param array $commands
	 */
	private function setCommands(array $commands) {
		$this->commands = $commands;
	}
	
	public function __destruct() {
		$connectionConnDataVariableExtractedFromDotConnFile = file_get_contents(__BASE_DIR__ . '.conn');
		$arrConnectionConnDataVariableExtractedFromDotConnFile = (explode(',', $connectionConnDataVariableExtractedFromDotConnFile));
		$connectionConnDataVariableExtractedFromDotConnFileDb_name = str_replace(' ', '', explode(':', $arrConnectionConnDataVariableExtractedFromDotConnFile[0])[1]);
		$connectionConnDataVariableExtractedFromDotConnFileDb_nameUser = str_replace(' ', '', explode(':', $arrConnectionConnDataVariableExtractedFromDotConnFile[1])[1]);
		$connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass = str_replace(' ', '', explode(':', $arrConnectionConnDataVariableExtractedFromDotConnFile[2])[1]);
		$HOST = str_replace(' ', '', explode(':', $arrConnectionConnDataVariableExtractedFromDotConnFile[3])[1]);
		$conn = new PDO("mysql:host=$HOST;dbname=$connectionConnDataVariableExtractedFromDotConnFileDb_name;charset=utf8", $connectionConnDataVariableExtractedFromDotConnFileDb_nameUser, $connectionConnDataVariableExtractedFromDotConnFileDb_nameUserPass, [PDO::ATTR_PERSISTENT => true]);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec("set names utf8");
		$command = (array)strpos($this->command, ' ') !== false ? explode(' ', $this->command) : $this->command;
		$cmd = $command[0];
		switch ($cmd) {
			case "paginate":
				$Controllers = explode(',', $command[1]);
				$output = [];
				foreach ($Controllers as $controller) {
					$controller = 'controller\\' . $controller;
					if (class_exists($controller)) {
						$controller = new $controller();
						if ($controller instanceof ControllerScheme) {
							if (!in_array(ControllersPagination::class, class_uses($controller))) {
								$output[] = ClassEditor::addTrait($controller->Path(), ControllersPagination::class);
							}
							if (!in_array(ViewPagination::class, class_uses($controller->ViewInstance()))) {
								$output[] = ClassEditor::addTrait($controller->ViewInstance()->Path(), ViewPagination::class);
							}
							$file = fopen(str_replace('.php', '.paginate.js', $controller->ViewInstance()->Path()), 'w');
							fwrite($file, "import {Pagination} from \"../../../modules/Pagination/Pagination\";
Pagination.currentPath = CurrentPathForController;
Pagination.paginate();");
							fclose($file);
						}
					}
				}
				$this->output(json_encode($output));
				break;
			case "export":
				if (isset($command[1])) {
					$arg1 = $command[1];
					if (strpos($arg1, ':') !== false) {
						$args = explode(':', $arg1);
						switch ($args[0]) {
							case "table":
								$tableName = end($args);
								if ($res = $conn->query("DESCRIBE $tableName")) {
									$str = "";
									while ($row = $res->fetchObject()) {
										if ($row->Key === "PRI") {
											$str .= "\$blueprint->primary_key('{$row->Field}');\n";
										} else {
											$len = 150;
											$type = $row->Type;
											if (strpos($type, '(') !== false) {
												$array = explode('(', $type);
												$type = $array[0];
												$len = $array[1];
												$len = str_replace(')', '', $len);
											}
											$typ = '';
											$isNullable = $row->Null === "Yes" ? "isNullable()" : "";
											switch ($type) {
												case "varchar":
													$str .= "\t\t\t\$blueprint->VarChar('{$row->Field}')->Len($len)";
													break;
												case "int":
													$str .= "\t\t\t\$blueprint->Int('{$row->Field}')->Len($len)";
													break;
												case "longtext":
													$str .= "\t\t\t\$blueprint->LongText('{$row->Field}')";
													break;
												default:
													$str .= "\t\t\t\$blueprint->Text('{$row->Field}')";
													break;
											}
											$str .= $isNullable;
											if (NULL !== $row->Default and strlen($row->Default) <= 0) {
												$str .= "->Default('{$row->Default}');\n";
											} else {
												$str .= ";\n";
											}
										}
									}
									$tblName = str_replace('tbl', '', $tableName);
									$source = __BASE_DIR__ . 'src/migration/' . time() . '_CLI_CLIENT_' . $tblName . '.php';
									$file = fopen($source, "w");
									$className = $tblName . 'Migration';
									$date = "<?php

namespace FwMigrationSystem\User;

use FwMigrationSystem\Main\Migratable;
use FwMigrationSystem\Main\Migration;
use FwMigrationSystem\Resources\Blueprint;
use FwMigrationSystem\Resources\TableName;

class $className extends Migratable {
    const modelName = '$tblName';

    public function create_table() {
        return Migration::Create(new TableName(self::modelName), function (Blueprint \$blueprint) {
            $str
             return \$blueprint;
        });
    }

    public function drop_table() {
        return Migration::DropIfExists(new TableName(self::modelName));
    }
}
";
									if ($file) {
										$this->output('Migration file created at ' . "<span style='color: rgba(255,138,0,0.89)'>" . 'migration/' . time() . '_CLI_CLIENT_' . $tblName . '.php' . "</span>", 'rgba(255,138,0,0.89)');
									} else {
										$this->output("File Creation Failed");
									}
									fwrite($file, $date);
									fclose($file);
								} else {
									$this->output('Basetable or view ' . $tableName . ' not found!');
								}
								break;
							case "bundle":
								$bundleName = $args[1];
								$bundleName = '\controller\\' . $bundleName;
								if (class_exists($bundleName)) {
									$Instance = new $bundleName();
									if ($Instance instanceof ControllerScheme) {
										$data_array = [];
										$data_array['Controller'] = [
											'path'    => $Instance->RelPath(),
											'content' => (file_get_contents($Instance->Path())),
										];
										$ModelInstance = $Instance->model();
										$Reflection = new ReflectionClass($ModelInstance);
										$data_array['Model'] = [
											'path'    => str_replace(__SOURCE__, '', $Reflection->getFileName()),
											'content' => (file_get_contents($Reflection->getFileName())),
										];
										$viewName = str_replace('controller', 'view', $bundleName);
										$Instance->loadView();
										$ViewInstance = new $viewName();
										if ($ViewInstance instanceof View)
											$data_array['View'] = [
												'path'    => str_replace(__SOURCE__, '', $ViewInstance->Path()),
												'content' => (file_get_contents($ViewInstance->Path())),
											];
										$table = TableDumper::dump(__BASE_DIR__ . '/run/tmp/tmp' . $ModelInstance::table . time() . '.sql', $ModelInstance::table);
										$db_array = [
											'table' => file_get_contents($table),
											'label' => '',
										];
										unlink($table);
										$final_array = [
											'Files' => $data_array,
											"Db"    => $db_array,
										];
										$file = '/run/tmp/tmp' . str_replace('tbl', '', $ModelInstance::table) . '_' . time() . '.json';
										$handle = fopen(__BASE_DIR__ . $file, 'w');
										$json = json_encode($final_array, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
										fwrite($handle, $json);
										fclose($handle);
										$host = FwConfig::HOST();
										$id = 'downlaod_' . str_replace('tbl', '', $ModelInstance::table) . '_' . time() . '.json';
										$this->output('<a href="https://' . $host . $file . '" download="' . str_replace('tbl', '', $ModelInstance::table) . '_' . time() . '.json' . '" id="' . $id . '"></a>
<script>
    document.getElementById("' . $id . '").click()
</script>
');
									}
								}
								break;
						}
					}
				}
				break;
			case "see_path":
				$this->output(json_encode($_SESSION['fw']['cli']));
				break;
			case "cd":
				$arg1 = isset($command[1]) ? $command[1] : '';
				switch ($arg1) {
					case "..":
						$dir = $_SESSION['fw']['cli']['__DIR__'];
						$arr = explode('/', $dir);
						unset($arr[sizeof($arr) - 1]);
						unset($arr[sizeof($arr) - 1]);
						$address = implode('/', $arr) . '/';
						if ($address === __BASE_DIR__) {
							$_SESSION['fw']['cli']['__DIR__'] = $address;
							$_SESSION['fw']['cli']['dir'] = '~';
						} else {
							$_SESSION['fw']['cli']['__DIR__'] = $address;
							$_SESSION['fw']['cli']['dir'] = end($arr);
						}
						$this->output($_SESSION['fw']['cli']['dir']);
						break;
					default:
						if ($arg1 == '') {
							$this->output('No file or directories specified!');
						} else {
							if (is_dir($_SESSION['fw']['cli']['__DIR__'] . $arg1)) {
								$address = $_SESSION['fw']['cli']['__DIR__'] . $arg1;
								$_SESSION['fw']['cli']['__DIR__'] = $address;
								$_SESSION['fw']['cli']['dir'] = (str_replace(__BASE_DIR__, '', $address) != '' ? str_replace(__BASE_DIR__, '', $address) : '~');
								$this->output(str_replace(__BASE_DIR__, '', $address));
							} else {
								$this->output("cd: no such file or directory $arg1");
							}
						}
						break;
				}
				break;
			case "truncate":
				$arg1 = isset($command[1]) ? $command[1] : '';
				if ($arg1 == '') {
					$this->output('There is no table specified!');
				} else {
					if (!startsWith($arg1, 'tbl')) {
						$arg1 = "tbl$arg1";
					}
					if ($this->tableExists($conn, $arg1)) {
						if ($conn->query("DELETE FROM $arg1")) {
							$this->output("Data from $arg1 was truncated successfully!", 'limegreen');
						} else {
							$this->output("We encountered an error while truncating $arg1!<br>Error: {$conn->errorInfo()[2]}");
						}
					} else {
						$this->output("table $arg1 not found!");
					}
				}
				break;
			case "wipe_errors":
				$i = 0;
				foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator('../src/')), '/./') as $file) {
					$fileName = $file->getFileName();
					if ($fileName == 'error_log') {
						$i++;
						unlink($file->getRealPath());
					}
				}
				if ($i > 0) {
					$this->output('Success', 'limegreen');
				} else {
					$this->output('No files to delete!', 'yellow');
				}
				break;
			case "wipe_session":
				$_SESSION = [];
				$this->output('success', 'limegreen');
				break;
			case "install":
				$arg1 = $command[1];
				switch ($arg1) {
					case "admins":
						if (importSql(__BASE_DIR__ . 'run/utils/admins.sql')) {
							$this->output('Admins took place successfully', 'limegreen');
						} else {
							$this->output();
						}
						break;
					case "template":
						if (importSql(__BASE_DIR__ . 'run/utils/template.sql')) {
							$this->output('Template installed successfully', 'limegreen');
						} else {
							$this->output('An error occurred');
						}
						break;
					case "migration":
						if (importSql(__BASE_DIR__ . 'run/utils/migration.sql')) {
							$this->output('Migration installed successfully', 'limegreen');
						} else {
							$this->output('An error occurred');
						}
						break;
					default:
						$name = $arg1;
						if (class_exists('fwCli\UserCommands\\' . $name . "Command") and !isset($this->commands[$arg1])) {
							$name[0] = strtoupper($name[0]);
							$name = $name . 'Command';
							$name = 'fwCli\UserCommands\\' . $name;
							if (file_put_contents(__BASE_DIR__ . 'run/processor.php', (file_get_contents(__BASE_DIR__ . 'run/processor.php')) . "\$Cli->addCommand(new $name());\n")) {
								$this->output('done', 'limegreen');
							} else {
								$this->output('Installation failed!');
							}
						} else {
							$this->output('There is no class implemented for ' . $name);
						}
				}
				break;
			case "ls":
				$data = scandir($_SESSION['fw']['cli']['__DIR__']);
				$output = '';
				$i = 0;
				foreach ($data as $item) {
					if ($item !== '.' and $item !== '..') {
						$i++;
						if (is_dir($_SESSION['fw']['cli']['__DIR__'] . $item)) {
							$output .= "<span class='span___test' style='color: rgba(0,38,255,0.89); margin: 0.4em'>$item</span>";
						} else {
							$output .= "<span class='span___test' style='margin: 0.4em;color: white'>$item</span>";
						}
					}
				}
				$this->output($output);
				break;
			case "make":
				if (isset($command[1])) {
					$arg1 = $command[1];
					if (strpos($arg1, ':') !== false) {
						$args = explode(':', $arg1);
						switch ($args[0]) {
							case "command":
								$cmdName = end($args);
								$cmdName[0] = strtoupper($cmdName[0]);
								$class_name = $cmdName . 'Command';
								$handler = fopen(__BASE_DIR__ . 'run/User/' . $class_name . '.php', 'w');
								$string = "<?php

namespace fwCli\UserCommands;

use fwCli\Write\UserCommands;
use UserCommand;

class $class_name extends UserCommands implements UserCommand {
    public function proccess(array \$args = array()) {
        return \$this->output('this function is set up successfully', 'limegreen');
    }
}
";
								fwrite($handler, $string);
								if ($handler) {
									$cmdName[0] = strtolower($cmdName[0]);
									$this->output("Command $cmdName is created successfully <br> <span style='color: orange'>run <code style='color: white'> install $cmdName </code> and start using your command</span>", 'limegreen');
								} else {
									$this->output("Failed in the proccess of creation the command $cmdName");
								}
								fclose($handler);
								exit();
								break;
						}
					}
				} else {
					$this->output("Usage: make [command]:arg", 'white');
				}
				break;
			case "see":
				$arg1 = $command[1];
				$addr = $_SESSION['fw']['cli']['__DIR__'] . $arg1;
				if (file_exists($addr) and !is_dir($addr)) {
					$output = str_replace(htmlentities('<?php'), '<label style="color: orange">' . htmlentities('<?php') . '</label>', (str_replace("\n", '<br>', htmlentities(file_get_contents($addr)))));
					$output = str_replace(htmlentities('<?'), '<label style="color: orange">' . htmlentities('<?') . '</label>', $output);
					$this->output($output, 'white');
				} else {
					$this->output("cd: no such file: $arg1");
				}
				break;
			case 'migrate':
				if (isset($command[1])) {
					$arg1 = $command[1];
					if (strpos($arg1, ':') !== false) {
						$args = explode(':', $arg1);
						switch ($args[0]) {
							case "make":
								$tblName = end($args);
								$source = __BASE_DIR__ . 'src/';
								if (!is_dir($source . 'migration/')) {
									mkdir($source . 'migration/', 0755);
								}
								foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__BASE_DIR__ . 'src/migration/')), '/' . $tblName . '\.php$/') as $phpFile) {
									$this->output("There is already a migration file created for '$tblName'");
									exit();
								}
								$source .= 'migration/' . time() . '_CLI_CLIENT_' . $tblName . '.php';
								$file = fopen($source, "w");
								$className = $tblName . 'Migration';
								$date = "<?php

namespace FwMigrationSystem\User;

use FwMigrationSystem\Main\Migratable;
use FwMigrationSystem\Main\Migration;
use FwMigrationSystem\Resources\Blueprint;
use FwMigrationSystem\Resources\TableName;

class $className extends Migratable {
    const modelName = '$tblName';

    public function create_table() {
        return Migration::Create(new TableName(self::modelName), function (Blueprint \$blueprint) {
            \$blueprint->primary_key();
             return \$blueprint;
        });
    }

    public function drop_table() {
        return Migration::DropIfExists(new TableName(self::modelName));
    }
}
";
								if ($file) {
									$this->output('Migration file created at ' . "<span style='color: rgba(255,138,0,0.89)'>" . 'migration/' . time() . '_CLI_CLIENT_' . $tblName . '.php' . "</span>", 'rgba(255,138,0,0.89)');
								} else {
									$this->output("File Creation Failed");
								}
								fwrite($file, $date);
								fclose($file);
								break;
							case "rem":
							{
								$tblName = end($args);
								$source = __BASE_DIR__ . 'src/';
								if (!is_dir($source . 'migration/')) {
									mkdir($source . 'migration/', 0755);
								}
								$i = 0;
								foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__BASE_DIR__ . 'src/migration/')), '/' . $tblName . '\.php$/') as $phpFile) {
									$i++;
									unlink($phpFile->getRealPath());
								}
								if ($i > 0) {
									$this->output("Migration file(s) for '$tblName' were/was deleted successfully", 'limegreen');
								} else {
									$this->output("No migration file found for '$tblName'");
								}
								break;
							}
						}
					} else {
						switch ($arg1) {
							case "undo":
								$res = $conn->query("SELECT * FROM migration_table ORDER BY migration_id DESC LIMIT 1;")->fetchObject();
								if ($res) {
									switch ($res->type) {
										case "create":
											$table = 'tbl' . $res->tblName;
											if ($conn->query("DESCRIBE $table")) {
												if ($conn->query("DROP TABLE IF EXISTS $table")) {
													$time = time();
													if ($conn->query("INSERT INTO migration_table (`tblName`,`date_time`,`fields`,`type`, `client`) VALUES ('{$res->tblName}', '$time', '{$res->fields}','delete','cli_undo')")) {
														$this->output("The creation of table '$table' is successfully undone!", 'limegreen');
													} else {
														
														$this->output("The creation of table '$table' is undone but this activity will be unknown to the migration system later!", 'red');
													}
												} else {
													$this->output("The creation of table '$table' could not be undone!", 'red');
												}
											} else {
												$this->output("I think you have already deleted table '$table' because i could not find it", 'red');
											}
											break;
									}
								} else {
									$this->output("No recent migration found!");
								}
								exit();
								break;
							case "redo":
								$res = $conn->query("SELECT * FROM migration_table WHERE `client` = 'cli_undo' ORDER BY migration_id DESC LIMIT 1;")->fetchObject();
								if ($res) {
									switch ($res->type) {
										case "create":
											$table = 'tbl' . $res->tblName;
											if ($conn->query("DESCRIBE $table")) {
												if ($conn->query("DROP TABLE IF EXISTS $table")) {
													$time = time();
													if ($conn->query("INSERT INTO migration_table (`tblName`,`date_time`,`fields`,`type`, `client`) VALUES ('{$res->tblName}', '$time', '{$res->fields}','delete','cli_redo')")) {
														$this->output("The deletion of table '$table' is successfully redone!", 'limegreen');
													} else {
														
														$this->output("The deletion of table '$table' is redone but this activity will be unknown to the migration system later!", 'red');
													}
												} else {
													$this->output("The deletion of table '$table' could not be redone!", 'red');
												}
											} else {
												$this->output("I think you have already deleted table '$table' because i could not find it", 'red');
											}
											break;
										case "delete":
											$table = 'tbl' . $res->tblName;
											if (!$conn->query("DESCRIBE $table")) {
												$model = $res->tblName;
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataTypes/String.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/ErrorHandling/MigrationException.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/TableName.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Schema/Migration.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Types.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Defaults.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Col.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/Blueprint.php';
												include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Migrateable.php';
												foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__BASE_DIR__ . 'src/migration/')), "/$model\.php$/") as $phpFile) {
													include $phpFile->getRealPath();
													$model = 'FwMigrationSystem\User\\' . $model . "Migration";
													$instance = new $model();
												}
												if (!($instance instanceof Migratable)) {
													$this->output("$model should extend the class 'Migratable'");
													exit();
												}
												if ($instance->create_table()) {
													$time = time();
													if ($conn->query("INSERT INTO migration_table (`tblName`,`date_time`,`fields`,`type`, `client`) VALUES ('{$res->tblName}', '$time', '{$res->fields}','create','cli_redo')")) {
														$this->output("The creation of table '$table' is successfully redone!", 'limegreen');
													} else {
														
														$this->output("The creation of table '$table' is redone but this activity will be unknown to the migration system later!", 'red');
													}
												} else {
													$this->output("The creation of table '$table' could not be redone!", 'red');
												}
											} else {
												$this->output("'$table' already exists", 'red');
											}
											break;
											break;
									}
								} else {
									$this->output("No recent migration found!");
								}
								exit();
								break;
						}
						$this->output($arg1);
					}
				} else {
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'DataTypes/String.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/ErrorHandling/MigrationException.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/TableName.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Schema/Migration.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Types.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Defaults.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Col.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/Blueprint.php';
					include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Migrateable.php';
					$i = 0;
					foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__BASE_DIR__ . 'src/migration/')), '/\.php$/') as $phpFile) {
						$file_name = str_replace('_CLI_CLIENT', '', $phpFile->getFileName());
						$file_name = str_replace('.php', '', $file_name);
						$arr = explode('_', $file_name);
						$timestamp = $arr[0];
						$model = end($arr);
						$res = $conn->query("SELECT * FROM migration_table where type = 'create' and tblName = '$model' ORDER BY migration_id DESC LIMIT 1;")->fetchObject();
						if (($res and $res->date_time > $timestamp) or class_exists('FwMigrationSystem\User\\' . $model . 'Migration')) {
						
						} else {
							include $phpFile->getRealPath();
							$instance = 'FwMigrationSystem\User\\' . $model . 'Migration';
							$instance = new $instance();
							if ($instance instanceof Migratable) {
								if (!$instance->create_table()) {
									$this->output("migration failed while migrating '$model'");
									exit();
								} else {
									$i++;
								}
							}
						}
					}
					$this->output("Migrated $i table(s)", 'limegreen');
				}
				break;
			default:
				$class = $this->getCommands()[$cmd];
				if ($class instanceof UserCommands) {
					$args = [];
					for ($i = 1; $i < sizeof($command); $i++) {
						if (isset($command[$i])) {
							$item = $command[$i];
							if (startsWith($item, '-')) {
								$i++;
								$args[str_replace('-', '', $item)] = $command[$i];
							}
						}
					}
					echo $class->proccess($args);
				} else {
					$this->output("command not found: {$this->command}");
				}
				break;
		}
		$content = ob_get_clean();
		$command = $this->command;
		$dir = ((isset($_SESSION['fw']['cli']['dir']) and $_SESSION['fw']['cli']['dir'] != '') ? $_SESSION['fw']['cli']['dir'] : '~/');
		$addr = endsWith($dir, '/') ? $dir : $dir . '/';
		$arr = explode('/', $addr);
		unset($arr[sizeof($arr) - 1]);
		$end = end($arr);
		echo(is_json($content) ? $content : json_encode(["dir"  => $end,
		                                                 "data" => "<span class='last_command'>$command</span><br><div style='color: red'>An error occurred<br>errorInfo: $content</div><br>",
		]));
	}
	
	private function output($data = 'An error occurred', $color = 'red') {
		$command = $this->command;
		$dir = ((isset($_SESSION['fw']['cli']['dir']) and $_SESSION['fw']['cli']['dir'] != '') ? $_SESSION['fw']['cli']['dir'] : '~/');
		$addr = endsWith($dir, '/') ? $dir : $dir . '/';
		$arr = explode('/', $addr);
		unset($arr[sizeof($arr) - 1]);
		$end = end($arr);
		echo json_encode(["dir"  => $end,
		                  "data" => "<span class='last_command'>$command</span><br><div style='color: $color'>$data</div><br>",
		]);
	}
	
	private function tableExists(PDO &$conn, string $tblName) {
		if ($conn->query("SHOW TABLES LIKE '$tblName'")->fetchObject()) {
			return true;
		} else {
			return false;
		}
	}
}
