<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Attrs\Style\Props\FormMethod;
use FwHtml\Elements\Attrs\Style\Props\Height;
use FwHtml\Elements\Attrs\Style\Props\Width;
use FwHtml\Elements\Tags\Types\ClosableTag;

class Iframe extends ClosableTag {

    /**
     * @param string $url
     * @return $this
     */
    public function Src(string $url){
        $this->addAttr('src',$url);
        return $this;
    }

    /**
     * @param Height $height
     * @return $this
     */
    public function Height(Height $height){
        $this->addAttr('height',$height::$value);
        return $this;
    }

    /**
     * @param Width $width
     * @return $this
     */
    public function Width(Width $width){
        $this->addAttr('width',$width::$value);
        return $this;
    }
}
