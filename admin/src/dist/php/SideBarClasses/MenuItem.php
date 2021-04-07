<?php

use FwAuthSystem\Main\UserObject;
use FwHtml\Elements\Tags\Main\HtmlTags;
use FwHtml\FontAwesome;

if (!class_exists('MenuItem')) {
    class MenuItem
    {
        private $Title = '';
        private $Icon = '';
        private $Padding_Right = null;
        private $Show = true;
        private $BgColor = 'bg-transparent';
        private $treeViewContent = [];
        private $linksTo = 'undefined';

        public function __construct(string $Title, FontAwesome $Icon, int $Padding_Right = null, bool $Show = true, string $BgColor = 'bg-transparent')
        {
            $this->Title = $Title;
            $this->Icon = $Icon;
            $this->Padding_Right = $Padding_Right;
            $this->Show = $Show;
            $this->BgColor = $BgColor;
        }

        public static function create(string $Title, FontAwesome $Icon, int $Padding_Right = null, bool $Show = true, string $BgColor = 'bg-transparent')
        {
            return new self($Title, $Icon, $Padding_Right, $Show, $BgColor);
        }

        public function LinksTo(string $controller)
        {
            if (class_exists($controller)) {
                if (UserObject::hasAccess($controller)) {
                    $path = str_replace('.php', '', str_replace(__SOURCE__ . 'controllers/', '', (new ReflectionClass($controller))->getFileName()));
                } else {
                    $path = null;
                    $this->Show = false;
                    return $this;
                }
            } else {
                $path = $controller;
            }
            $this->linksTo = $path;
            return $this;
        }

        public function _items(array $items)
        {
            $this->treeViewContent = $items;
            return $this;
        }

        public function __debugInfo()
        {
            return array('Title' => $this->Title, 'Icon' => $this->Icon, 'Padding_right' => $this->Padding_Right, 'Show' => $this->Show);
        }

        public function __toString()
        {
            $treeViewContent = $this->treeViewContent;
            $output = '';
            if (sizeof($treeViewContent) > 0) {
                $children = '';
                foreach ($treeViewContent as $value) {
                    $children .= $value->__toString();
                }
                $pr = $this->Padding_Right !== null ? ".pr-'.{$this->Padding_Right}" : '';
                if ($this->Show) {
                    return HtmlTags::Li('.nav-item.has-treeview' . $pr)
                        ->Content(
                            HtmlTags::A('.nav-link')->Href('#')
                                ->Content(
                                    HtmlTags::I(".nav-icon")->Class($this->Icon),
                                    HtmlTags::P()
                                        ->Content(
                                            $this->Title,
                                            HtmlTags::I('.right.fa.fa-angle-left')
                                        )
                                ),
                            HtmlTags::Ul('.nav.nav-treeview')
                                ->Content($children)
                        )->__toString();
                } else {
                    return '';
                }
            } else {
                if ($this->Show) {
                    return HtmlTags::Li('.nav-item.pr-' . $this->Padding_Right)
                        ->Content(
                            HtmlTags::A('.nav-link.ajax')->Rel($this->linksTo)
                                ->Content(
                                    HtmlTags::I(".nav-icon")->Class($this->Icon),
                                    HtmlTags::P()
                                        ->Content(
                                            $this->Title
                                        )
                                )
                        )->__toString();
                } else {
                    return '';
                }
            }
        }
    }
}