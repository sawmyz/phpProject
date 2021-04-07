<?php

use DATABASE\ORM\Interact\Entities\EntityScheme;

if (isset($_REQUEST['controller_type'])) {
    switch ($_REQUEST['controller_type']) {
        case 'fw_autocomplete':
            $res = FwConnection::conn()->query("select * from INFORMATION_SCHEMA.TABLES where `TABLE_TYPE` = 'BASE TABLE'");
            $output = array();
            while ($row = $res->fetchObject()) {
                $output[] = $row->TABLE_NAME;
            }
            echo json_encode($output);
            break;
        case "make":
            $tblName = $_POST['tblName'];
            $res = FwConnection::conn()->query("select * from template_data where tbl_name = '$tblName'")->fetchObject();
            $labels = json_decode($res->label_data, true);
            $type_data = json_decode($res->type_data, true);
            $form_data = json_decode($res->form_data, true);
            $join_data = json_decode($res->join_data, true);
            $image_data = json_decode($res->image_data, true);
            $validation_data = json_decode($res->validation_data, true);
            $ths = '';
            $arrayOfColumns = [];
            $i = 0;
            $inputs = '';
            $selects = '';
            $arrayOfImages = [];
            $tbKey = $_POST['tblKey'];
            $remove = explode('_',$tbKey)[0].'_';
            $entityProps = "public \$$tbKey;";

            $removed = str_replace($remove,'',$tbKey);
            $dict = "'id' => '$tbKey',";
            foreach ($labels as $key => $datum) {
                $removed = str_replace($remove,'',$key);
                $entityProps .= "\npublic \$$removed;\n";
                $dict .= "'$removed' => '$key',";
                if ($type_data[$key] == 'input') {
                    $i++;
                    if ($i <= 3) {
                        $ths .= "HtmlTags::Th('$datum'),";
                        $arrayOfColumns[] = "'" . $key . "'";
                    }
                    switch ($validation_data[$key]) {
                        case 'Mobile':
                            $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->Mobile('" . $key . "','" . $key . "') .
                            \$this->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'Price':
                            $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->Price('" . $key . "','" . $key . "') .
                            \$this->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'Tel':
                            $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->Tel('" . $key . "','" . $key . "') .
                            \$this->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'Number':
                            $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->Number('" . $key . "','" . $key . "') .
                            \$this->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'English':
                            $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->English('" . $key . "','" . $key . "') .
                            \$this->Html()->FormGroupEnd() .
                            ";
                            break;
                        case 'input':
                        default:
                            $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->Input('" . $key . "') .
                            \$this->Html()->FormGroupEnd() .
                            ";
                            break;
                    }
                } elseif ($type_data[$key] == 'select') {
                    $jClass = $join_data[$key] != '*' ? "new \model\\$join_data[$key]()" : "''";
//                    if ($i <= 3) {
//                        $ths = "HtmlTags::Th('$datum')),";
//                        $arrayOfColumns[] = "'" . $key . "' => $jClass";
//                    }
                    $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->Select('" . $key . "', '" . $key . "', selectByClass($jClass)) .
                            \$this->Html()->FormGroupEnd() .
                            ";
                } elseif ($type_data[$key] == 'image') {
                    $arrayOfImages[] = $key;
                    $width = $image_data[$key]['width'];
                    $height = $image_data[$key]['height'];
                    $inputs .= "
                            \$this->Html()->FormGroupStart(" . $form_data[$key] . ") .
                            \$this->Html()->Label('" . $datum . "') .
                            \$this->Html()->ImageInput('" . $key . "','" . $image_data[$key]['type'] . "',$width,$height).
                            \$this->Html()->FormGroupEnd() .
                            ";
                }
            }
            $inputs = trim($inputs);
            $selects = trim($selects);
            $inputs = endsWith($inputs, '.') ? substr($inputs, 0, strlen($inputs) - 1) : $inputs;
            $selects = $inputs == '' ? endsWith($selects, '.') ? substr($selects, 0, strlen($selects) - 1) : $selects : $selects;
            $address = $_POST['address'];
            $addressArray = explode('/', $address);
            $pathToModels = __SOURCE__ . 'models/';
            $pathToControllers = __SOURCE__ . 'controllers/';
            $pathToViews = __SOURCE__ . 'views/';
            $pathToEntities = __SOURCE__ . 'entities/';
            foreach ($addressArray as $item) {
                if (!is_dir($pathToModels . $item)) {
                    mkdir($pathToModels . $item, 0777);
                }
                if (!is_dir($pathToControllers . $item)) {
                    mkdir($pathToControllers . $item, 0777);
                }
                if (!is_dir($pathToViews . $item)) {
                    mkdir($pathToViews . $item, 0777);
                }
                if (!is_dir($pathToEntities . $item)) {
                    mkdir($pathToEntities . $item, 0777);
                }
                $pathToModels .= $item . '/';
                $pathToControllers .= $item . '/';
                $pathToViews .= $item . '/';
                $pathToEntities .= $item . '/';
            }


            $entityContent = "<?php
namespace model\Entity;
use DATABASE\ORM\Interact\Entities\EntityScheme;
class {$_POST['name']}Entity extends EntityScheme {
    $entityProps

    public function model() {
        return new \model\\{$_POST['name']}();
    }



    protected function dictionary(): array {
        return  [
            $dict
        ];
    }
}
";


            $path = (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR);
            $entityName = $_POST['name'];
            $model = fopen(__SOURCE__ . 'models' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.php', "w");
            $controller = fopen(__SOURCE__ . 'controllers' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.php', "w");
            $view = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.view.php', "w");
            $entity = fopen(__SOURCE__ . 'entities' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) .  $_POST['name'] . '.entity.php', "w");
            fwrite($entity,$entityContent);
            fclose($entity);
//            $addView = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . $path . 'add' . $_POST['name'] . '.php', "w");
//            $ediView = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . 'edit' . $_POST['name'] . '.php', "w");
//            $delView = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . 'delete' . $_POST['name'] . '.php', "w");
//            $viewView = fopen(__SOURCE__ . 'views' . DIRECTORY_SEPARATOR . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . 'view' . $_POST['name'] . '.php', "w");
            $string = "<?php\nnamespace model;\nuse DATABASE\Model;\n";
            $string .= "class " . $_POST["name"] . "  extends Model {\n";
            if (sizeof($arrayOfImages) > 0) {
                $File_ARRAY = '[';
                foreach ($arrayOfImages as $image) {
                    $File_ARRAY .= '"' . $image . '" => __SOURCE__."images/' . $_POST['name'] . '/"';
                }
                $File_ARRAY .= '];';
            }
            if (!is_dir(__SOURCE__.'images/')){
                mkdir(__SOURCE__.'images/',0755);
            }
            if (!is_dir(__SOURCE__.'images/'.$_POST['name'].'/')){
                mkdir(__SOURCE__.'images/'.$_POST['name'].'/',0755);
            }
            $imageString = '';
            if ($File_ARRAY){
                $imageString = "\npublic static \$__uploads = $File_ARRAY\n\n";
            }
            $controllerString = "<?php
namespace controller;
use ControllerScheme;
class {$_POST['name']} extends ControllerScheme {
    const name = '{$_POST['controller_name']}';
    $imageString
}";
            $string .= "    public \$_table = " . "'$tblName';\n";
            $string .= "    public \$_key = " . "'$tbKey';\n";
            $string .= "    public \$_Entity =  \model\Entity\\{$_POST['name']}Entity::class;\n}";
            fwrite($model, $string);
            fwrite($controller, $controllerString);
            $mainFunc =   "public function main(Document &\$document)
    {
        \$document->html = \$this->Html()->BreadCrumbs() . HtmlTags::Section('.content')
                ->Content(
                    HtmlTags::Div('.row')
                        ->Content(
                            HtmlTags::Div('.col-md-12')->Content(
                                HtmlTags::Div('.card.card-primary.card-outline')
                                    ->Content(
                                        HtmlTags::Div('.card-header')
                                            ->Content(
                                                \$this->Html()->CardTitle(),
                                                \$this->Html()->refreshAndAdd()
                                            ),
                                        HtmlTags::Div('.card-body.d-flex.flex-wrap')
                                            ->Content(
                                                HtmlTags::Table('.table.table-bordered.table-striped')
                                                    ->Content(
                                                        HtmlTags::Thead('.table-dark')
                                                            ->Content(
                                                                HtmlTags::Tr()->Content(
                                                                    HtmlTags::Th('ردیف')->Width('50'),
                                                                    $ths
                                                                    HtmlTags::Th('.no-sort عملیات')->Width('150')
                                                                )
                                                            ),
                                                        HtmlTags::Tbody()
                                                            ->Content(
                                                                \$this->show([" . implode(',', $arrayOfColumns) . "])
                                                            )
                                                    )
                                            )
                                    )
                            )
                        )
                );
    }";
            $editFunc = "public function edit(Document &\$document)
    {
        \$this->doFill();
        \$document->html = \$this->Form();
    }";
            $deleteFunc = "public function delete(Document &\$document)
    {
        \$this->doFill();
        \$this->doDisableAll();
        \$document->html = \$this->Form();
    }";
            $viewFunc = "public function view(Document &\$document)
    {
        \$this->doFill();
        \$this->doDisableAll();
        \$document->html = \$this->Form();
    }";
            $addFunc = "public function add(Document &\$document)
    {
        \$document->html = \$this->Form();
    }";
            $formFunc = "public function Form()
    {
        return \$this->Html()->BreadCrumbs() .HtmlTags::Section('.content')
    ->Content(
        HtmlTags::Div('.row')
            ->Content(
                HtmlTags::Div('.col-md-12')->Content(
                    HtmlTags::Div('.card.card-primary.card-outline')
                        ->Content(
                            HtmlTags::Div('.card-header')
                                ->Content(
                                    \$this->Html()->CardTitle(),
                                    \$this->Html()->refreshAndBack()
                                ),
                                    \$this->Html()->FormStart().
                                    $selects  $inputs .
                                    \$this->Html()->CardFooter()
                        )
                )
            )
    );
    }";
            $final = "<?
namespace view;
use DOMWrap\Document;
use FwHtml\Elements\Tags\Main\HtmlTags;
use View;
class {$_POST['name']} extends View
{

    public \$SingularName = '".$_POST['controller_name']."';

    $mainFunc
    
    $formFunc
    
    $addFunc
    
    $editFunc
    
    $deleteFunc
    
    $viewFunc

}
        ";
            fwrite($view,$final);
            fclose($model);
            fclose($controller);
            fclose($view);
            $tmp__path = (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'];
            $name = $_POST['controller_name'].' ها';
            FwConnection::conn()->query("INSERT INTO template_sidebar (title,link) VALUES ('$name','$tmp__path')");
            echo showResult($model, 'مدل در ' . (endsWith($_POST['address'], DIRECTORY_SEPARATOR) ? $_POST['address'] : $_POST['address'] . DIRECTORY_SEPARATOR) . $_POST['name'] . '.php', 'ساختن');
            break;
        case "getFormData":
            $tblName = $_REQUEST['tblName'];
            $output = array();
            $result = $conn->query("select * from INFORMATION_SCHEMA.COLUMNS as clmn left join INFORMATION_SCHEMA.`TABLES` as tbl on clmn.TABLE_NAME = tbl.TABLE_NAME  where tbl.`TABLE_TYPE` = 'BASE TABLE' and tbl.`TABLE_NAME` = '$tblName'");
            if ($result) {
                while ($res = $result->fetchObject()) {
                    if (strpos($res->COLUMN_COMMENT, "HIDDEN") === false and $res->COLUMN_KEY !== 'PRI') {
                        $type = $res->DATA_TYPE;
                        $info = array("name" => $res->COLUMN_NAME, "label" => $res->COLUMN_COMMENT, "required" => $res->IS_NULLABLE === 'NO' ? true : false);
                        $output[] = $info;
                    }
                }
            } else {
                $output['state'] = 'Not Found';
            }
            echo json_encode($output);
            break;
    }
}
