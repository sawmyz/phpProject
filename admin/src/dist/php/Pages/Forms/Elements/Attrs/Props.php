<?php
namespace FwHtml\Elements\Attrs\Props;
abstract class Props {
    /**
     * @return mixed
     */
    public function __toString() {
        return $this::$value;
    }
}
