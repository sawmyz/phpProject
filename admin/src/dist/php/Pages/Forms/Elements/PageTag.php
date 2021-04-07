<?php
namespace FwHtml\Elements\Tags;

use FwHtml\Elements\Tags\Types\ClosableTag;

class PageTag extends ClosableTag {
	protected function getTag(): string {
		return "page";
	}
}
