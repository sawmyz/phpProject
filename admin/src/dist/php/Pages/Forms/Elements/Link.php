<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Attrs\Style\Props\Height;
use FwHtml\Elements\Attrs\Style\Props\Width;
use FwHtml\Elements\Tags\Types\ClosableTag;

class Link extends ClosableTag {

    /**
     * @param string $rel
     * @return $this
     */
    public function Rel(string $rel) {
        $this->addAttr('rel',$rel);
        return $this;
    }

    /**
     * @param string $href
     * @return $this
     */
    public function Href(string $href) {
        $this->addAttr('href',$href);
        return $this;
    }
}
