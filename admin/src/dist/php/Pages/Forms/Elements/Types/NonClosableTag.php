<?php
namespace FwHtml\Elements\Tags\Types;
use FwHtml\Elements\Tags\Base\TagsClass;

abstract class NonClosableTag extends TagsClass {
    /**
     * NonClosableTag constructor.
     */


    /**
     * @return string
     */
    final public function __toString() {
        $array = [];
        foreach ($this->getAttrs() as $attrName => $attr){
            if (strlen($attr) > 0) {
                $array[] = "$attrName='$attr'";
            } else {
                $array[] = "$attrName";
            }
        }
        return '<'.$this->getTag().' '.html_entity_decode(implode(' ',$array)).' >';
    }

    /**
     * @return string
     */
    final public function __html() {
        $array = [];
        foreach ($this->getAttrs() as $attrName => $attr){
            if (strlen($attr) > 0) {
                $array[] = "$attrName='$attr'";
            } else {
                $array[] = "$attrName";
            }
        }
        return '<'.$this->getTag().' '.html_entity_decode(implode(' ',$array)).' >';
    }
}
