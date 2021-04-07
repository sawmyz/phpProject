<?php

namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Tags\Types\NonClosableTag;

class Input extends NonClosableTag {
	
	public static $_text = 'text';
	public static $_file = 'file';
	public static $_number = 'number';
	public static $_color = 'color';
	public static $_time = 'time';
	
	
	/**
	 * @param string $inputName
	 * @return $this
	 */
	public function Name(string $inputName) {
		$this->addAttr('name', $inputName);
		return $this;
	}
	
	/**
	 * @param string $value
	 * @return $this
	 */
	public function Value(string $value) {
		$this->addAttr('value', $value);
		return $this;
	}
	
	/**
	 * @param string $placeholder
	 * @return $this
	 */
	public function PlaceHolder(string $placeholder) {
		$this->addAttr('placeholder', $placeholder);
		return $this;
	}
	
	/**
	 * @param bool $on
	 * @return $this
	 */
	public function AutoComplete(bool $on) {
		$this->addAttr('autocomplete', $on ? 'on' : 'off');
		return $this;
	}
	
	/**
	 * @param bool $isDisabled
	 * @return $this
	 */
	public function Disabled(bool $isDisabled = true) {
		
		if ($isDisabled)
			$this->addAttr('disabled');
		else
			$this->removeAttr('disabled');
		return $this;
	}
	
	/**
	 * @param bool $isReadonly
	 * @return $this
	 */
	public function Readonly(bool $isReadonly = true) {
		if ($isReadonly)
			$this->addAttr('readonly');
		else
			$this->removeAttr('readonly');
		return $this;
	}
	
	/**
	 * @param bool $isRequired
	 * @return $this
	 */
	public function Required(bool $isRequired = true) {
		
		if ($isRequired)
			$this->addAttr('required');
		else
			$this->removeAttr('required');
		return $this;
	}
	
	/**
	 * @param string $type
	 * @return $this
	 */
	public function Type(string $type) {
		$this->addAttr('type', $type);
		return $this;
	}
}
