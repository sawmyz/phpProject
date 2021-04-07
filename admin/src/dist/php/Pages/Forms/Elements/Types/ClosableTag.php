<?php

namespace FwHtml\Elements\Tags\Types;

use FwHtml\Elements\Tags\Base\TagsClass;
use fwPageHelper\Forms\Resources\FormException;
use Str;

abstract class ClosableTag extends TagsClass {
	private $content = [];

	/**
	 * @return string
	 */
	final public function __toString() {
		$array = [];
		foreach ($this->getAttrs() as $attrName => $attr) {
			if (strlen($attr) > 0) {
				$array[] = "$attrName='$attr'";
			} else {
				$array[] = "$attrName";
			}
		}
		$content = '';
		foreach ($this->getContent() as $item) {
//                if ($item instanceof ClosableTagContent){
//                    var_dump(htmlentities($item->getParent()));
//                echo "<br>";
//                echo "<br>";
//                echo "<br>";
//            }
			$content .= ($item->getParent());
		}

		return ('<' . $this->getTag() . ' ' . html_entity_decode(implode(' ', $array)) . '>' . $content . "</{$this->getTag()}>");
	}

	/**
	 * @return array
	 */
	protected function getContent(): array {
		return $this->content;
	}

	/**
	 * @param array $content
	 */
	protected function setContent(array $content) {
		$this->content = $content;
	}

	/**
	 * @return $this
	 */
	final public function Content() {
		$contentArr = [];
		foreach (func_get_args() as $arg) {
			if (null !== $arg) {
				if ($arg instanceof TagsClass) {
					$contentArr[] = new ClosableTagContent($arg);
				} elseif (is_string($arg)) {
					$contentArr[] = new ClosableTagContent(new Str($arg));
				} elseif (is_array($arg)) {
					$contentArr[] = new ClosableTagContent(new Str(implode('', $arg)));
				} elseif (is_callable($arg)) {
					$val = $arg();
					if (is_object($val) and $val instanceof TagsClass) {
						$contentArr[] = new ClosableTagContent($val);
					} elseif (is_string($val)) {
						$contentArr[] = new ClosableTagContent(new Str($val));
					} elseif (is_array($val)) {
						$contentArr[] = new ClosableTagContent(new Str(implode('', $val)));
					}
				}
			}
		}
		$content = $this->getContent();
		$content = array_merge($content, $contentArr);
		$this->setContent($content);
		return $this;
	}
}
