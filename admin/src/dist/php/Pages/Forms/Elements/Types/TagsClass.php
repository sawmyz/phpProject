<?php

namespace FwHtml\Elements\Tags\Base;

use FwHtml\Elements\Attrs\Style;
use FwHtml\Elements\Tags\Types\ClosableTag;

abstract class TagsClass implements \JsonSerializable {
    private $attrs = [];
    private $Tag = 'div';

    public function jsonSerialize (){
        return $this->__toString();
    }
    final public function __construct(string $emmet = '') {
        $this->setTag(strtolower(end(explode('\\', get_class($this)))));
        if (strlen($emmet) > 0) {
            $str = $emmet;
            if (strpos($emmet, '#') !== false) {
                $emmet = preg_filter('/#[a-zA-Z\d@$%^&*_\-()[\]]+/', '', $emmet);
                $id = str_replace('#', '', str_replace($emmet, '', $str));
                $this->Id($id);
                $str = $emmet;
            }
            $emmet = $this->checkAttrs($emmet);
            if (strpos($emmet, '.') !== false) {
                if (substr_count($emmet, '.')) {
                    $arr = explode('.', $emmet);
                    foreach ($arr as $item) {
                        if (strlen($item) > 0) {
                            $secArr = explode(' ',$item);
                            $this->Class($secArr[0]);
                        }
                    }
                }
                $emmet = preg_filter('/\.[a-zA-Z\d@$%^&*_\-()[\]]+/', '', $emmet);
            }
            if ($this instanceof ClosableTag and strlen($emmet) > 0) {
                $this->Content($emmet);
            }
        }
    }

    /**
     * @param string $IdName
     * @return $this
     */
    public function Id(string $IdName) {
        $this->addAttr('id', $IdName);
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     */
    protected function addAttr(string $name, string $value = '') {
        $this->attrs[$name] = $value;
    }

    /**
     * @param string $name
     */
    protected function removeAttr(string $name) {
        if (isset($this->attrs[$name])){
            unset($this->attrs[$name]);
        }
    }

    private function checkAttrs($emmet) {
        if (strpos($emmet, '[') !== false and strpos($emmet, ']') !== false) {
            $attr = get_string_between($emmet, '[', ']');
            $array = explode('=', $attr);
            $emmet = str_replace("[$attr]", '', $emmet);
            $this->Attrs([$array[0] => $array[1]]);
            return $this->checkAttrs($emmet);
        } else {
            return $emmet;
        }
    }

    /**
     * @param array $arrayOfAttributes
     * @return $this
     */
    public function Attrs(array $arrayOfAttributes) {
        foreach ($arrayOfAttributes as $attribute => $value) {
            if (is_string($attribute) and strlen($value) > 0) {
                $this->addAttr($attribute, $value);
            } else {
                $this->addAttr($value);
            }
        }
        return $this;
    }

    /**
     * @param string $className
     * @return $this
     */
    public function Class(string $className) {
        if ($class = $this->getAttrs()['class']) {
            $class .= " $className";
        } else {
            $class = $className;
        }
        $this->addAttr('class', $class);
        return $this;
    }

    /**
     * @return array
     */
    protected function getAttrs(): array {
        return $this->attrs;
    }

    /**
     * @param array $attrs
     */
    protected function setAttrs(array $attrs) {
        $this->attrs = $attrs;
    }

    /**
     * @param $name
     * @param array $arguments
     * @return $this
     */
    public function __call($name, array $arguments) {
        $this->addAttr($name, $arguments[0]);
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function Data_(string $name, string $value) {
        $this->addAttr("data-$name", $value);
        return $this;
    }
    public function Title(string $value) {
        $this->addAttr("title", $value);
        return $this;
    }

    /**
     * @param Style $style
     * @return $this
     */
    public function Style(Style $style) {
        $this->addAttr('style', $style->__toString());
        return $this;
    }

    /**
     * @return string
     */
    protected function getTag(): string {
        return $this->Tag;
    }

    /**
     * @param string $Tag
     */
    protected function setTag(string $Tag) {
        $this->Tag = $Tag;
    }
}
