<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Tags\Types\ClosableTag;

class Option extends ClosableTag {

    /**
     * @param string $label
     * @return $this
     */
    public function Label(string $label) {
        $this->addAttr('label',$label);
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function Value(string $value) {
        $this->addAttr('value',$value);
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
    public function Selected() {
        $this->addAttr('selected');
        return $this;
    }
}
