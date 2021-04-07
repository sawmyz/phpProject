<?php

namespace controller;
//include __BASE_DIR__.'src/autoload.php';
use Api\ApiInterface;
use ControllerScheme;
use FwConnection;
use FwHtml\Elements\Tags\Main\HtmlTags;
use model\Entity\IndividualsEntity;
use DATABASE\ORM\QueryBuilder\QueryBuilder\Db;


class Customers extends ControllerScheme
{
    use ApiInterface;

    const name = 'مشتری';
    public static $__uploads = ["customer_image" => __SOURCE__ . "images/Customers/"];



    
    public function userstatus()
    {
        $params = (array) json_decode(file_get_contents('php://input'), TRUE);
        $_POST['phone']= $params['phone'];


        if (isset($_POST["phone"])) {
            $phone = $_POST["phone"];

            $id = \model\Individuals::getAllFiltered("individual_mobile", $phone)->first()->individual_id;

            if ($id) {
                $user = $this->model()::getAllFiltered("individual_id", $id)->first();
                if ($user != null) {

                    header("Status: 202");
                    return "ok!";
                }
                else
                    {
                    header("Status: 206");
                    return "ثبت نام کاربر تکمیل نیست";
                }
            }
            else
                {
                   header("Status: 203");
                   return "کاربر یافت نشد";
            }
        }
        else {
            header("Status: 402");
            return "شماره موبایل را وارد کنید";
        }
    }


    public function sendsms()
    {
        $params = (array) json_decode(file_get_contents('php://input'), TRUE);
        $_POST['mobile']= $params['mobile'];
        if (isset($_POST["mobile"])) {


            $mobile = $_POST["mobile"];
            //check if mobile number is assigned to individual
            if ($individual = \model\Individuals::getAllFiltered("individual_mobile", $mobile)->first()) {
                //check if mobile number is assigned to customer
                if ($customer = \model\Customers::getAllFiltered("individual_id", $individual->individual_id)->first()) {
                    $code = rand(100000, 999999);
                    if (sendVerify("$mobile", [$code])) {
                        \model\Customers::edit($customer->customer_id, [
                            'customer_sms_code' => $code
                        ]);
                        header("Status: 201");
                        return "customer updated";


                    }

                } else {
                    //individual but not customer
                    $code = rand(100000, 999999);
                    sendVerify("$mobile", [$code]);
                    \model\Customers::add([
                        'individual_id' => ($individual->individual_id),
                        'customer_sms_code' => $code
                    ]);
                    header("Status: 202");
                    return "customer created";

                }
            } else {
                //not individual
                \model\individuals::add([
                    'individual_mobile' => $mobile
                ]);
                $individual = \model\Individuals::getAllFiltered("individual_mobile", $mobile)->first();
                $code = rand(100000, 999999);
                sendVerify("$mobile", [$code]);
                \model\Customers::add([
                    'individual_id' => ($individual->individual_id),
                    'customer_sms_code' => $code
                ]);
                header("Status: 202");
                return "individual created";
            }

        } else{
            header("Status: 402");
            return "mobile_number required!";
        }
    }

    public function Codevalidate()
    {
        $params = (array) json_decode(file_get_contents('php://input'), TRUE);
        $_POST['mobile']= $params['mobile'];
        $_POST['code']= $params['code'];

        if (isset($_POST["mobile"])) {
            if (isset($_POST["code"])) {

                $code = $_POST["code"];
                $mobile = $_POST["mobile"];
                $individual = \model\Individuals::getAllFiltered("individual_mobile", $mobile)->first();

                if ($individual) {
                    $customer = \model\Customers::getAllFiltered("individual_id", $individual->individual_id)->first();

                    if ($customer->customer_sms_code == $code) {

                        $fname=$individual->individual_first_name;
                        $lname=$individual->individual_last_name;
                        if($fname and $lname){
                            header("Status: 202");
                            return "sabtenam takmil ast";
                        }
                        else {
                            header("Status: 207");
                            return "ok";
                        }

                    } else {
                        header("Status: 206");
                        return "sms_code is wrong!";

                    }
                } else {
                    header("Status: 203");
                    return "this_mobile_number is not registered!";
                }
            } else {
                header("Status: 207");
                return "sms_code required!";
            }
        } else {
            header("Status: 402");
            return "mobile_number required!";
        }
    }


    public function register()
    {
        $params = (array) json_decode(file_get_contents('php://input'), TRUE);
        $_POST['fname']= $params['fname'];
        $_POST['lname']= $params['lname'];
        $_POST['mobile']= $params['mobile'];
        $_POST['password']= $params['password'];
        $_POST['email']= $params['email'];

        if (isset($_POST["fname"])) {
            $fname = $_POST["fname"];
        } else return "first_name required!";

        if (isset($_POST["lname"])) {
            $lname = $_POST["lname"];
        } else return "last_name required!";

        if (isset($_POST["mobile"])) {
            $mobile = $_POST["mobile"];
        } else return "mobile_number required!";

        if (isset($_POST["password"])) {
            $password = $_POST["password"];
        } else return "password required!";

        if (isset($_POST["email"])) {
            $email = $_POST["email"];
        }

        //updating user info

        if($individual=\model\Individuals::getAllFiltered("individual_mobile",$mobile)->first()){
            if($customer=\model\Customers::getAllFiltered("individual_id", $individual->individual_id)->first()){

                $data1=[
                    'individual_first_name'=>$fname,
                    'individual_last_name'=>$lname
                ];
                $data2=[
                    'customer_password'=>$password,
                    'customer_email'=>$email
                ];
                \model\Individuals::edit($individual->individual_id,$data1);
                \model\Customers::edit($customer->customer_id,$data2);
                header("Status: 202");
                return "ok";

            }
            else {
                header("Status: 204");
                return "false";
            }
        } else {
            header("Status: 204");
            return "false";
        }

    }
}