<?php
namespace FwHtml\Elements\Attrs;
use FwHtml\Elements\Attrs\Props\Props;

class Style {
    private $arrayOfStyles = array();

    /**
     * Style constructor.
     * @param array $styles
     */
    public function __construct(array $styles) {
        foreach ($styles as $style) {
            if ($style instanceof Props) {
                $this->addStyle($style::name,$style::$value);
            }
        }
    }

    /**
     * @return string
     */
    public function __toString() {
        $array = [];
        foreach ($this->getArrayOfStyles() as $style => $value){
            $array[] = " $style: $value";
        }
        return implode(';',$array);
    }

    /**
     * @return array
     */
    private function getArrayOfStyles(): array {
        return $this->arrayOfStyles;
    }

    /**
     * @param array $arrayOfStyles
     */
    private function setArrayOfStyles(array $arrayOfStyles) {
        $this->arrayOfStyles = $arrayOfStyles;
    }

    /**
     * @param string $name
     * @param string $value
     */
    protected function addStyle(string $name, string $value) {
        $this->arrayOfStyles[$name] = $value;
    }
}

/**
 * @param array $styles
 * @return Style
 */
function Style(array $styles) {
    return new Style($styles);
}
