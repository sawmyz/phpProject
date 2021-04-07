<?php

use FwHtml\Elements\Tags\Main\HtmlTags;
use FwHtml\FontAwesome;

if (!class_exists('Sidebar')) {
    class Sidebar
    {
        private $arrayOfItems = [];
        private $clean = true;
        public function __construct(bool $clean = true)
        {
            $this->clean = $clean;
        }

        public function Item(string $Title, FontAwesome $Icon, int $Padding_Right = null, bool $Show = true, string $BgColor = 'bg-transparent')
        {
            $object =new MenuItem($Title, $Icon, $Padding_Right, $Show, $BgColor);
            $this->arrayOfItems[] = $object;
            return $object;
        }

        public function render()
        {
            $object =HtmlTags::Ul('.nav.nav-pills.nav-sidebar.flex-column[data-widget=treeview]')->Data_('accordion','false')->Role('menu')
                ->Content(
                    implode('',$this->arrayOfItems)
                );
            if ($this->clean){
                $object->Id('cleanSideBar');
            }
            echo $object;
        }

    }
}