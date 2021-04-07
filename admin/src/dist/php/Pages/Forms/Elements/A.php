<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Attrs\Style\Props\Target;
use FwHtml\Elements\Tags\Types\ClosableTag;

class A extends ClosableTag {

    /**
     * @param string $href
     * @return $this
     */
    public function Href(string $href){
        $this->addAttr('href',$href);
        return $this;
    }

    /**
     * @param string $fileName
     * @return $this
     */
    public function Download(string $fileName){
        $this->addAttr('download',$fileName);
        return $this;
    }

    /**
     * @param string $rel
     * @return $this
     */
    public function Rel(string $rel){
        $this->addAttr('rel',$rel);
        return $this;
    }

    /**
     * @param Target $target
     * @return $this
     */
    public function Target(Target $target){
        $this->addAttr('target',$target::$value);
        return $this;
    }
}
