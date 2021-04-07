<?php

namespace controller;

use ControllerScheme;
use FwAuthSystem\Main\UserObject;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;

class Providers extends ControllerScheme
{
    const name = 'پذیرنده';

    public static $__uploads = ["provider_image" => __SOURCE__ . "images/Providers/"];

    //ha//

    public function providerStatus()
    {
        $status = $_POST['status'];
        $id = $_POST['id'];
        $desc = $_POST['desc'];
        if ($desc == '') {
            $desc = ' ';
        }
        if ($status == 2) $status = 0;
        if ($status == -1) $status = 0;
        if ($this->model()::edit($id, ['provider_status' => $status, 'provider_status_desc' => $desc])) {
            return true;
        } else {
            return false;
        }
    }

    public function providerStatusDesc()
    {
        $id = $_POST['id'];
        return $this->model()::get($id)->provider_status_desc;
    }


    public function main()
    {
        $user = UserObject::instance();
        $userId = $user->getUserId();
        if ($user->getRole() == 'SupervisorsRole') {
            foreach (\model\Visitors::getAllFiltered("user_id", $userId) as $item) {
//                if (isActive($this, $item)) {
                return $this->view($this->viewName(), 'main', [
//                    $this->model()::getAllFiltered('visitor_id', $item->visitor_id)
                ]);
//                }
            }
        }
        if ($user->getRole() == 'AdminRole') {
            return $this->view($this->viewName(), 'main', [
                $this->model()::getAllFiltered('provider_status', 1)
            ]);
        }

        return $this->view($this->viewName(), 'main', [
            $this->model()::getAll()
        ]);


    }





//    public function main()
//    {
//        $user = UserObject::instance();
//        $userId = $user->getUserId();
//        $visitors = \model\Visitors::getAllFiltered("user_id", $userId);
//
//        foreach ($visitors as $item) {
//            if (isActive($this, $item)) {
//                $output[] = $this->model()::getAllFiltered('visitor_id', $item->visitor_id);
//                if ($user->getRole() == 'SupervisorsRole') {
//                    return $this->view($this->viewName(), 'main', [
//                        $this->model()::getAllFiltered('visitor_id', $item->visitor_id)
//                    ]);
//                }
//
//                if ($user->getRole() == 'AdminRole') {
//                    return $this->view($this->viewName(), 'main', [
//                        $this->model()::getAllFiltered('provider_status', 1)
//                    ]);
//                }
//
//                return $this->view($this->viewName(), 'main', [
//                    $this->model()::getAll()
//                ]);
//            }
//        }
//
//    }
    //ha//
}