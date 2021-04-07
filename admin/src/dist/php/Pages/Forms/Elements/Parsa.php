<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Tags\Types\NonClosableTag;

class Parsa extends NonClosableTag {
    public function Value(){
        return $this;
    }
}
