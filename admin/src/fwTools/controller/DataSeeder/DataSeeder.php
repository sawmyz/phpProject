<?php
use DATABASE\Model;
use Seeder\utils\Generators;

if (!isset($_REQUEST['controller_type'])){
    $output = [];
    foreach (new RegexIterator(new RecursiveIteratorIterator(new RecursiveDirectoryIterator(__SOURCE__ . 'models/')), '/\.php$/') as $phpFile) {
        $modelName = getClassFromFile($phpFile->getRealPath());
        $modelName = "\model\\$modelName";
        $controllerName = "\controller\\".getClassFromFile(str_replace('models/','controllers/',$phpFile->getRealPath()));
        if (class_exists($modelName)) {
            $instanceOfModel = new $modelName();
        } else {
            die('Model Does Not Exist!');
        }
        if (class_exists($controllerName)) {
            $instanceOfController = new $controllerName();
        } else {
            die('Controller Does Not Exist!');
        }
        if ($instanceOfModel instanceof Model) {
            $table =  $instanceOfModel::table;
        }
        if ($instanceOfController instanceof ControllerScheme) {
            $name = $instanceOfController::name;
            $name = endsWith($name,'ها') ? $name : "$name ها";
        }
        $output[$table]['name'] = $name;
        $countName = 'count(*)';
        $output[$table]['count'] = (FwConnection::conn()->query("SELECT count(*)
FROM information_schema.columns
WHERE table_name = '$table'")->fetchObject()->$countName) - 1;
    }
    echo "controller_key: test ||||||"  . json_encode($output);
} elseif ($_REQUEST['controller_type'] == 'get'){
    $table = $_REQUEST['table'];
    $res = FwConnection::conn()->query("SELECT * FROM INFORMATION_SCHEMA.COLUMNS where `TABLE_NAME` = '$table'");
    $output = [];
    while ($row = $res->fetchObject()){
        if ($row->COLUMN_KEY !='PRI') {
            $output['cols'][]['name'] = $row->COLUMN_NAME;
        }
    }
    $output['table'] = $table;
    echo "controller_key: test ||||||"  . json_encode($output);
} elseif ($_REQUEST['controller_type'] == 'submit'){
    require_once __SOURCE__ . 'fwTools/controller/DataSeeder/utils/algorithms.php';


    $Generator = new Generators();
    $table = $_REQUEST['table'];
    $data = $_REQUEST['name'];
    $info = array();
    $finalInfo = array();
    $state = array();
    $states = array();
    $cities = array();
    $mobiles = array();
    $nCodes = array();
    $tels = array();
    $usernames = array();
    $fnames = array();
    $lnames = array();
    $emails = array();
    $fname = 'پارسا';
    $count = is_numeric($_REQUEST['count']) ? $_REQUEST['count'] : 0;
    for ($i = 0; $i < $count; $i++) {
        foreach ($data as $index => $value) {
            if ($value != '') {
                switch ($value) {
                    case "state":
                        $j = 0;
                        while (true) {
                            $j++;
                            $state = $Generator->getState();
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/states.json'), true))) {
                                if (!in_array($state, $states)) {
                                    $info[$index] = $state['id'];
                                    $states[] = $state;
                                    break;
                                }
                            } else {
                                $info[$index] = $state['id'];
                                break;
                            }
                        }
                        break;
                    case "state_name":
                        $j = 0;
                        while (true) {
                            $j++;
                        $state = $Generator->getState();
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/states.json'), true))) {
                                $info[$index] = $state['name'];
                                var_dump($state['name']);
                                break;
                            } else {
                                $info[$index] = $state['name'];
                                break;
                            }
                        }
                        break;
                    case  "city":
                        $j = 0;
                        while (true) {
                            $j++;
                            $city = $Generator->getCity($states);
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/cities.json'), true))) {
                                if (!in_array($city, $cities)) {
                                    $info[$index] = $city['id'];
                                    $cities[] = $city;
                                    break;
                                }
                            } else {
                                $info[$index] = $city['id'];
                                break;
                            }
                        }
                        break;
                    case  "city_name":
                        $j = 0;
                        while (true) {
                            $j++;
                            $city = $Generator->getCity();
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/cities.json'), true))) {
                                $info[$index] = $city['name'];
                                break;
                            } else {
                                $info[$index] = $city['name'];
                                break;
                            }
                        }
                        break;
                    case  "state_by_city":
                        $j = 0;
                        while (true) {
                            $j++;
                            if (!isset($city)){
                                $city = $Generator->getCity();
                            }
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/cities.json'), true))) {
                                $info[$index] = $city['state'];
                                break;
                            } else {
                                $info[$index] = $city['state'];
                                break;
                            }
                        }
                        break;
                    case "mobile":
                        $j = 0;
                        while (true) {
                            $j++;
                            $mobile = $Generator->generateMobileNum();
                            if (!in_array($mobile, $mobiles)) {
                                $info[$index] = $mobile;
                                $mobiles[] = $mobile;
                                break;
                            }
                        }
                        break;
                    case "tel":
                        $j = 0;
                        while (true) {
                            $j++;
                            $tel = $Generator->generateTelNum($state);
                            if (!in_array($tel, $tels)) {
                                $info[$index] = $tel;
                                $tels[] = $tel;
                                break;
                            }
                        }
                        break;
                    case "fname":
                        $j = 0;
                        while (true) {
                            $j++;
                            $fname = $Generator->generateName();
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/fnames.json'), true))) {
                                if (!in_array($fname, $fnames)) {
                                    $info[$index] = $fname;
                                    $fnames[] = $fname;
                                    break;
                                }
                            } else {
                                $info[$index] = $fname;
                                break;
                            }
                        }
                        break;
                    case "lname":
                        $j = 0;
                        while (true) {
                            $j++;
                            $lname = $Generator->generateName();
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/lnames.json'), true))) {
                                if (!in_array($lname, $lnames)) {
                                    $info[$index] = $lname;
                                    $lnames[] = $lname;
                                    break;
                                }
                            } else {
                                $info[$index] = $lname;
                                break;
                            }
                        }
                        break;
                    case "username":
                        $j = 0;
                        while (true) {
                            $j++;
                            $username = $Generator->generateUserName($fname);
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/fnames.json'), true))) {
                                if (!in_array($username, $usernames)) {
                                    $info[$index] = $username;
                                    $usernames[] = $username;
                                    break;
                                }
                            } else {
                                $info[$index] = $username;
                                break;
                            }
                        }
                        break;
                    case "word":
                        $info[$index] = $Generator->generateAWord();
                        break;
                    case "nCode":
                        $j = 0;
                        while (true) {
                            $j++;
                            $nCode = $Generator->generateNcode();
                            if (!in_array($nCode, $nCodes)) {
                                $info[$index] = $nCode;
                                $nCodes[] = $nCode;
                                break;
                            }
                        }
                        break;
                    case "password":
                        $info[$index] = $Generator->generatePassword();
                        break;
                    case "email":
                        $j = 0;
                        while (true) {
                            $j++;
                            $email = $Generator->generateEmail($fname);
                            if ($j < sizeof(json_decode(file_get_contents(__DIR__ . '/utils/fnames.json'), true))) {
                                if (!in_array($email, $emails)) {
                                    $info[$index] = $email;
                                    $emails[] = $email;
                                    break;
                                }
                            } else {
                                $info[$index] = $email;
                                break;
                            }
                        }
                        break;
                    case "time":
                        $info[$index] = time();
                        break;
                    default:
                        if ($value != '0' and $value != 0) {
                            throw new Error('Invalid Data');
                        }
                }
            }
        }
        $finalInfo[] = $info;
    }

    foreach ($finalInfo as $item) {
        if (sizeof($item) > 0) {
            $fields = '';
            $values = '';
            foreach ($item as $key => $value) {
                if (strlen($value) > 0) {
                    $fields .= " $key,";
                    $values .= "'$value',";
                }
            }
            $fields = substr($fields, 0, strlen($fields) - 1);
            $values = substr($values, 0, strlen($values) - 1);
            var_dump(FwConnection::conn()->query("INSERT INTO `$table` (" . $fields . ") VALUES (" . $values . ")"));
            echo "<br>";
        }
    }

}
