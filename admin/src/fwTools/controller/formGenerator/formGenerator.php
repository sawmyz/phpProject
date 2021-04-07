<?php
if (isset($_REQUEST['controller_type'])) {
    switch ($_REQUEST['controller_type']) {
        case "make":
            $tblName = 'tbl' . $_POST['tblName'];
            $tmpTableName = strtolower($_POST['tblName']);
            $tableName = new Str($tblName);
            $tableName = $tableName->replace('tbl', '')->__toString();
            $tableNameArray = str_split($tableName);
            $newArray = [];
            foreach ($tableNameArray as $index => $value) {
                if (preg_match('~^\p{Lu}~u', $value)) {
                    $value = strtolower($value);
                    $newArray[] = "_$value";
                } else {
                    $newArray[] = $value;
                }
            }
            $id = substr(implode('', $newArray),1,strlen(implode('', $newArray)) - 2).'_id';
            $primary_key = $id;
            $names = $_POST['name'];
            $types = $_POST['type'];
            $col_typs = $_POST['col_type'];
            $labels = $_POST['label'];
            $sizes = $_POST['slider'];
            $validations = $_POST['validations'];
            $imageData = $_POST['imageData'];
            $column_data = array();
            $label_data = array();
            $type_data = array();
            $join_data = array();
            $form_data = array();
            $image_data = array();
            $validation_data = array();
            if (sizeof($names) == sizeof($types) and sizeof($types) == sizeof($labels)) {
                $query = "CREATE TABLE $tblName (
                                    $primary_key INT(11) AUTO_INCREMENT PRIMARY KEY,";
                foreach ($names as $index => $name) {
                    $query .= "
                        $name $types[$index](150) COMMENT \"$labels[$index]\",
                                ";
                    $column_data[$name] = $types[$index];
                    $label_data[$name] = $labels[$index];
                    $type_data[$name] = $col_typs[$index];
                    $join_data[$name] = isset($_POST['class'][$index]) ? $_POST['class'][$index] : '*';
                    $form_data[$name] = $sizes[$index];
                    $validation_data[$name] = isset($validations[$index]) ? $validations[$index] : 'ImageInput';
                    if (isset($imageData[$index])) {
                        $image_data[$name] = ($imageData[$index]);
                    }
                }
                $query = trim($query);
                $query = substr($query, 0, strlen($query) - 1);
                $query .= '  )';
                $column_data = json_encode($column_data, JSON_UNESCAPED_UNICODE);
                $label_data = json_encode($label_data, JSON_UNESCAPED_UNICODE);
                $type_data = json_encode($type_data, JSON_UNESCAPED_UNICODE);
                $join_data = json_encode($join_data, JSON_UNESCAPED_UNICODE);
                $image_data = json_encode($image_data, JSON_UNESCAPED_UNICODE);
                $validation_data = json_encode($validation_data, JSON_UNESCAPED_UNICODE);
                $form_data = json_encode($form_data, JSON_UNESCAPED_UNICODE);
                $res = FwConnection::conn()->query("
                    insert into template_data 
                        (tbl_name,
                         column_data,
                         label_data,
                         type_data,
                         join_data,
                         image_data,
                         validation_data,
                         form_data)
                      VALUES ('$tblName',
                              '$column_data',
                              '$label_data',
                              '$type_data', 
                              '$join_data',
                              '$image_data',
                              '$validation_data',
                              '$form_data')");
                if (FwConnection::conn()->query($query)){

                    if ($res = FwConnection::conn()->query("DESCRIBE $tblName")) {
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
                                if (null !== $row->Default and strlen($row->Default) <= 0) {
                                    $str .= "->Default('{$row->Default}');\n";
                                } else {
                                    $str .= ";\n";
                                }
                            }
                        }
                        $tblName = str_replace('tbl', '',$tblName);
                        $source .= __BASE_DIR__ . 'src/migration/' . time() . '_CLI_CLIENT_' . $tblName . '.php';
                        $file = fopen($source, "w");
                        $className = $tblName . 'Migration';
                        $data = "<?php

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

                        fwrite($file, $data);
                        fclose($file);
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/ErrorHandling/MigrationException.php';
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/TableName.php';
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Schema/Migration.php';
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Types.php';
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Defaults.php';
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Columns/Col.php';
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Blueprint/Blueprint.php';
                        include __BASE_DIR__ . 'src/dist' . DIRECTORY_SEPARATOR . 'php' . DIRECTORY_SEPARATOR . 'Migration/Migrateable.php';
                        require_once $source;
                        $className = "FwMigrationSystem\User\\$className";
                        $instance = new $className();
                        if ($instance instanceof \FwMigrationSystem\Main\Migratable){
                            FwConnection::conn()->query("DROP TABLE tbl$tblName");
                              var_dump($instance->create_table());
                        }
                    }
                }

                if ($res) {
                    echo showSuccessMsg('جدول' . $tmpTableName, 'ساخت');
                } else {
                    echo showErrorMsg('جدول' . $tmpTableName, 'ساخت');
                }
            }
            break;
    }
}
