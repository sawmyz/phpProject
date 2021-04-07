<?php
namespace FwHtml\Elements\Tags\Types;
use FwHtml\Elements\Tags\Base\TagsClass;

class ClosableTagContent  {
    private $parent = null;

    /**
     * ClosableTagContent constructor.
     * @param $parent
     */
    final public function __construct($parent) {
        $this->setParent($parent);
    }

    /**
     * @return TagsClass
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param TagsClass $parent
     */
    private function setParent($parent) {
        $this->parent = $parent;
    }
    public function __debugInfo() {
        return array('parent' => $this->getParent());
    }
}
