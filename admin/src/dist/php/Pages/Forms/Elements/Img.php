<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Attrs\Style\Props\Height;
use FwHtml\Elements\Attrs\Style\Props\Width;
use FwHtml\Elements\Tags\Types\NonClosableTag;

class Img extends NonClosableTag {

    /**
     * @param string $alt
     * @return $this
     */
    public function Alt(string $alt) {
        $this->addAttr('alt',$alt);
        return $this;
    }

    /**
     * @param string $crossorigin
     * @return $this
     */
    public function CrossOrigin(string $crossorigin) {
        $this->addAttr('crossorigin',$crossorigin);
        return $this;
    }

    /**
     * @param Height $height
     * @return $this
     */
    public function Height(Height $height) {
        $this->addAttr('height',$height);
        return $this;
    }

    /**
     * @param Width $width
     * @return $this
     */
    public function Width(Width $width) {
        $this->addAttr('height',$width);
        return $this;
    }

    /**
     * @param string $src
     * @return $this
     */
    public function Src(string $src) {
        $this->addAttr('src',$src);
        return $this;
    }
}
