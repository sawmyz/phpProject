<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Attrs\Style\Props\FormMethod;
use FwHtml\Elements\Tags\Types\ClosableTag;

class Form extends ClosableTag {

    /**
     * @param string $action
     * @return $this
     */
    public function Action(string $action){
        $this->addAttr('action',$action);
        return $this;
    }

    /**
     * @param FormMethod $method
     * @return $this
     */
    public function Method(FormMethod $method){
        $this->addAttr('method',$method);
        return $this;
    }
}
