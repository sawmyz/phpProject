<?php

namespace FwHtml\Elements\Tags;

use Controller;
use FwHtml\Elements\Tags\Types\ClosableTag;
use FwHtml\Elements\Tags\Types\ClosableTagContent;
use Str;

class Select extends ClosableTag {
    /**
     * @param string $inputName
     * @return $this
     */
    public function Name(string $inputName) {
        $this->addAttr('name', $inputName);
        return $this;
    }

    public function From(Controller $controller, string $methodName, array $arrayOfIndexed, string $seprator = '') {
        global $conn;
        $result = '';
        $data = $controller->$methodName();
        if (is_json($controller->$methodName())) {
            $data = json_decode($controller->$methodName());
        }
        foreach ($data as $item) {
            $result .= '<option value="' . $item->district_id . '">';
            foreach ($arrayOfIndexed as $index => $value) {
                if (is_string($index) and is_string($value) and function_exists($index)) {
                    $result .= call_user_func_array($index, array($item->$value));
                } else {
                    if (is_object($value)) {
                        if (strpos($index, '\\') !== false) {
                            $array = explode('\\', $index);
                            $output = [];
                            foreach ($array as $testAble) {
                                if (strpos($testAble, '(') !== false and strpos($testAble, ')')) {
                                    $arr = explode('(', $testAble);
                                    $function_name = $arr[0];
                                    unset($arr[0]);
                                    $arr = implode('', $arr);
                                    $arr = (explode(',', str_replace(')', '', $arr)));
                                    if (function_exists($function_name)) {
                                        $resObject = join_class($value, $item->{$value::key});
                                        $paramArr = [];
                                        foreach ($arr as $concat) {
                                            if (startsWith($concat, '-') and endsWith($concat, '-')) {
                                                $concat = str_replace('-', '', $concat);
                                                $paramArr[] = (null !== $resObject->$concat ? $resObject->$concat : $concat);
                                            } else {
                                                $paramArr[] = $concat;
                                            }
                                        }
                                        $output[] = call_user_func_array($function_name, $paramArr);
                                    } else {
                                        $output[] = (null !== join_class($value, $item->{$value::key}, $testAble)) ? join_class($value, $item->{$value::key}, $testAble) : $testAble;
                                    }
                                } else {
                                    $output[] = (null !== join_class($value, $item->{$value::key}, $testAble)) ? join_class($value, $item->{$value::key}, $testAble) : $testAble;
                                }
                            }
                            $result .= (implode($output));
                        } else {
                            $result .= join_class($value, $item->{$value::key}, $index);
                        }
                    } else {
                        if (strpos($value, '\\') !== false) {
                            $array = explode('\\', $value);
                            $output = [];
                            foreach ($array as $testAble) {
                                if (strpos($testAble, '(') !== false and strpos($testAble, ')')) {
                                    $arr = explode('(', $testAble);
                                    $function_name = $arr[0];
                                    unset($arr[0]);
                                    $arr = implode('', $arr);
                                    $arr = (explode(',', str_replace(')', '', $arr)));
                                    if (function_exists($function_name)) {
                                        $resObject = join_class($value, $item->{$value::key});
                                        $paramArr = [];
                                        foreach ($arr as $concat) {
                                            if (startsWith($concat, '-') and endsWith($concat, '-')) {
                                                $concat = str_replace('-', '', $concat);
                                                $paramArr[] = (null !== $resObject->$concat ? $resObject->$concat : $concat);
                                            } else {
                                                $paramArr[] = $concat;
                                            }
                                        }
                                        $output[] = call_user_func_array($function_name, $paramArr);
                                    } else {
                                        $output[] = (null !== $item->$testAble) ? $item->$testAble : $testAble;
                                    }
                                } else {
                                    $output[] = (null !== $item->$testAble) ? $item->$testAble : $testAble;
                                }
                            }
                            $result .= (implode($output));
                        } else {
                            $result .= $item->$value;
                        }
                    }
                }
                $result .= $seprator;
            }
            $result .= '</option>';
        }
        $content = $this->getContent();
        $content[] = new ClosableTagContent(new Str($result));
        $this->setContent($content);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function Value(string $value) {
        $this->addAttr('value', $value);
        return $this;
    }

    /**
     * @return $this
     */
    public function Disabled() {
        $this->addAttr('disabled');
        return $this;
    }

    /**
     * @return $this
     */
    public function Required() {
        $this->addAttr('required');
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    public function Type(string $type) {
        $this->addAttr('type', $type);
        return $this;
    }

    /**
     * @param bool $isMultiple
     * @return $this
     */
    public function Multiple(bool $isMultiple) {
        $this->addAttr('multiple', $isMultiple ? 'true' : 'false');
        return $this;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function Size(int $size) {
        $this->addAttr('size', "$size");
        return $this;
    }
}
