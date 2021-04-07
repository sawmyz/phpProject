<?php
class IconCenter {
    public $icon;
    public $picker;

    function __construct() {
        $this->icon = null;
        $this->picker = null;
    }

    function iconCenter($inputValue = false, string $pathToImages = 'images', string $inputName = 'icon_id') {
        global $conn;
        $query = "SELECT * FROM `tblIcons`";
        $result = $conn->query($query);
        $options = '<div id="iconCenterPicker">';
        while ($row = $result->fetchObject()) {
            $options .= '<img src="' . $pathToImages . '/IconCenter/' . $row->image . '" alt="' . $row->icon_id . '">';
        }
        $options .= '</div>';
        if ($inputValue) {
            $options .= '<input value="' . $inputValue . '" type="hidden" id="iconCenterInput" name="' . $inputName . '">';
            return $options;
        }
        $options .= '<input type="hidden" value="" id="iconCenterInput" name="' . $inputName . '">';
        $this->setPicker($options);
        return $this->picker;
    }

    protected function setPicker($picker) {
        $this->picker = $picker;
    }

    function getIcon(string $id, $path = 'images') {
        global $conn;
        $res = $conn->query("SELECT * FROM tblIcons where icon_id = '$id'")->fetchObject();
        $this->setIcon('<img style="width: 65px;height: auto" src="' . $path . '/IconCenter/' . $res->image . '" alt="' . $res->icon_id . '">');
        return $this->icon;
    }

    protected function setIcon($icon) {
        $this->icon = $icon;
    }
}
