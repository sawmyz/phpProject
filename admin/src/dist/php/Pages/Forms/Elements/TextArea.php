<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Tags\Types\ClosableTag;
use FwHtml\Elements\Tags\Types\NonClosableTag;

class TextArea extends ClosableTag {

    /**
     * @param string $inputName
     * @return $this
     */
    public function Name(string $inputName) {
        $this->addAttr('name',$inputName);
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
     * @param int $cols
     * @return $this
     */
    public function Cols(int $cols) {
        $this->addAttr('cols',"$cols");
        return $this;
    }

    /**
     * @param int $rows
     * @return $this
     */
    public function Rows(int $rows) {
        $this->addAttr('rows',"$rows");
        return $this;
    }

    /**
     * @param int $maxlength
     * @return $this
     */
    public function MaxLength(int $maxlength) {
        $this->addAttr('maxlength',"$maxlength");
        return $this;
    }

    /**
     * @param string $placeholder
     * @return $this
     */
    public function PlaceHolder(string $placeholder) {
        $this->addAttr('placeholder',$placeholder);
        return $this;
    }

    /**
     * @param bool $on
     * @return $this
     */
    public function AutoFocus(bool $on) {
        $this->addAttr('autofocus',$on ? 'on' : 'off');
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
    public function Readonly() {
        $this->addAttr('readonly');
        return $this;
    }

    /**
     * @return $this
     */
    public function Required() {
        $this->addAttr('required');
        return $this;
    }
}
