<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Tags\Types\ClosableTag;

class Label extends ClosableTag {

    /**
     * @param string $href
     * @return $this
     */
    public function For(string $href){
        $this->addAttr('for',$href);
        return $this;
    }
}
