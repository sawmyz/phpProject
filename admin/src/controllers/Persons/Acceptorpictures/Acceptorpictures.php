<?php

namespace controller;

use ControllerScheme;

class Acceptorpictures extends ControllerScheme
{
    const name = 'گالری پذیرنده';
    public static $__uploads = ["acceptor_photo_image" => __SOURCE__ . "images/Acceptorpictures/"];

    public function main()
    {
        if ($this->requestArray()['provider_branch_id'] > 0) {
            return $this->view($this->viewName(), 'main', [
                $this->model()->getAllFiltered('provider_branch_id', $this->requestArray()['provider_branch_id'])
            ]);
        }
        return parent::main();
    }
}